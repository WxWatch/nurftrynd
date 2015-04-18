//
//  BannedStat.h
//  NURF Trynd
//
//  Created by James Glenn on 4/17/15.
//  Copyright (c) 2015 Rockfish. All rights reserved.
//

#import <Realm/Realm.h>
#import "Champion.h"

@interface BannedStat : RLMObject
@property NSInteger championId;
@property Champion *champion;
@property NSInteger games;
@property NSInteger total;
@end

// This protocol enables typed collections. i.e.:
// RLMArray<BannedStat>
RLM_ARRAY_TYPE(BannedStat)
