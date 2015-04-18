//
//  ChampionManager.m
//  NURF Trynd
//
//  Created by James Glenn on 4/17/15.
//  Copyright (c) 2015 Rockfish. All rights reserved.
//

#import "ChampionManager.h"

@implementation ChampionManager

#pragma mark - Public Method

+ (id)sharedInstance
{
    static ChampionManager *sharedMyInstance = nil;
    static dispatch_once_t onceToken;
    dispatch_once(&onceToken, ^{
        sharedMyInstance = [[self alloc] init];
    });
    
    return sharedMyInstance;
}

- (NSString*)championRealmPath {
    NSString *path = [[NSBundle mainBundle] pathForResource:@"ChampionInfo" ofType:@"realm"];
    return path;
}

- (Champion *)championWithChampionId:(NSInteger)championId {
    RLMRealm *realm = [RLMRealm realmWithPath:[self championRealmPath]];
    return [Champion objectInRealm:realm forPrimaryKey:@(championId)];
}

#pragma mark - Lifecycle
- (id) init
{
    if (self = [super init]) {
        // Set up properties here
    }
    return self;
}


@end
