//
//  TrendingTableViewCell.h
//  NURF Trynd
//
//  Created by James Glenn on 4/17/15.
//  Copyright (c) 2015 Rockfish. All rights reserved.
//

#import <UIKit/UIKit.h>
#import "PlayedStat.h"
#import "BannedStat.h"

@interface TrendingTableViewCell : UITableViewCell

- (void)setupWithBan:(BannedStat *)stat;
- (void)setupWithStat:(PlayedStat*)stat;

@end
