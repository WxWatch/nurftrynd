//
//  GetBannedChampionsService.m
//  NURF Trynd
//
//  Created by James Glenn on 4/17/15.
//  Copyright (c) 2015 Rockfish. All rights reserved.
//

#import "GetBannedChampionsService.h"
#import "AFNetworking.h"
#import "BannedStat.h"
#import "ChampionManager.h"

@implementation GetBannedChampionsService

- (void)getBannedStatsWithRegion:(Region*)region withSuccess:(void (^)(RLMResults *stats))successBlock andFailure:(void (^)(NSError *error))failureBlock {
    AFHTTPRequestOperationManager *mang = [[AFHTTPRequestOperationManager alloc] initWithBaseURL:[NSURL URLWithString:@"http://lolmobile.net/challenge/"]];
    mang.operationQueue = [[NSOperationQueue alloc] init];
    mang.requestSerializer = [AFJSONRequestSerializer serializer];
    mang.responseSerializer = [AFJSONResponseSerializer serializer];
    
    NSString *url = @"http://lolmobile.net/challenge/api/v1/champions/banned";
    NSDictionary *params = nil;
    if (region) {
        params = @{ @"region": region.abbreviation };
    }
    
    NSError *error;
    NSMutableURLRequest *request = [mang.requestSerializer requestWithMethod:@"GET" URLString:url parameters:params error:&error];
    
    AFHTTPRequestOperation *operation = [mang HTTPRequestOperationWithRequest:request success:^(AFHTTPRequestOperation *operation, id responseObject) {
        
        RLMRealm *realm = [RLMRealm defaultRealm];
        [realm beginWriteTransaction];
        [realm deleteObjects:[BannedStat allObjects]];
        
        for (NSString *key in responseObject[@"champions"]) {
            NSString *value = responseObject[@"champions"][key];
            
            BannedStat *playedStat = [BannedStat new];
            playedStat.championId = [key integerValue];
            playedStat.games = [value integerValue];
            playedStat.champion = [[ChampionManager sharedInstance] championWithChampionId:[key integerValue]];
            playedStat.total = [responseObject[@"total"] integerValue];
            [realm addOrUpdateObject:playedStat];
        }
        
        [realm commitWriteTransaction];
        
        RLMResults *results = [BannedStat allObjects];
        
        if (successBlock) {
            successBlock(results);
        }
        
    } failure:^(AFHTTPRequestOperation *operation, NSError *error) {
        NSLog(@"Failure");
    }];
    
    [mang.operationQueue addOperation:operation];
}

@end
