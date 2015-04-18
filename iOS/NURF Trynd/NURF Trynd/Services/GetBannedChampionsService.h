//
//  GetBannedChampionsService.h
//  NURF Trynd
//
//  Created by James Glenn on 4/17/15.
//  Copyright (c) 2015 Rockfish. All rights reserved.
//

#import <Foundation/Foundation.h>
#import <Realm/Realm.h>
#import "Region.h"

@interface GetBannedChampionsService : NSObject

- (void)getBannedStatsWithRegion:(Region*)region withSuccess:(void (^)(RLMResults *stats))successBlock andFailure:(void (^)(NSError *error))failureBlock;

@end
