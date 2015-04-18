//
//  ChampionManager.h
//  NURF Trynd
//
//  Created by James Glenn on 4/17/15.
//  Copyright (c) 2015 Rockfish. All rights reserved.
//

#import "Champion.h"
@interface ChampionManager : NSObject

+ (ChampionManager*)sharedInstance;

- (Champion*)championWithChampionId:(NSInteger)championId;

@end
