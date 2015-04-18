//
//  TrendingTableViewCell.m
//  NURF Trynd
//
//  Created by James Glenn on 4/17/15.
//  Copyright (c) 2015 Rockfish. All rights reserved.
//

#import "TrendingTableViewCell.h"
#import "UIImageView+AFNetworking.h"

@interface TrendingTableViewCell ()
@property (weak, nonatomic) IBOutlet UIImageView *championImageView;
@property (weak, nonatomic) IBOutlet UILabel *championName;
@property (weak, nonatomic) IBOutlet UILabel *championTitle;
@property (weak, nonatomic) IBOutlet UILabel *gamePercent;
@property (weak, nonatomic) IBOutlet UILabel *gameCount;

@end

@implementation TrendingTableViewCell

- (void)setupWithBan:(BannedStat *)stat {
    NSString *imageBase = @"http://ddragon.leagueoflegends.com/cdn/5.2.1/img/champion/";
    NSURL *url = [NSURL URLWithString:[NSString stringWithFormat:@"%@%@", imageBase, stat.champion.image.full]];
    [self.championImageView setImageWithURL:url];
    self.championName.text = stat.champion.name;
    self.championTitle.text = stat.champion.title;
    self.gameCount.text = [NSString stringWithFormat:@"%ld games", (long)stat.games];
    self.gamePercent.text = [NSString stringWithFormat:@"%.1f%%", ((float)stat.games/(float)stat.total) * 100];
}

- (void)setupWithStat:(PlayedStat *)stat {
    NSString *imageBase = @"http://ddragon.leagueoflegends.com/cdn/5.2.1/img/champion/";
    NSURL *url = [NSURL URLWithString:[NSString stringWithFormat:@"%@%@", imageBase, stat.champion.image.full]];
    [self.championImageView setImageWithURL:url];
    self.championName.text = stat.champion.name;
    self.championTitle.text = stat.champion.title;
    self.gameCount.text = [NSString stringWithFormat:@"%ld games", (long)stat.games];
    self.gamePercent.text = [NSString stringWithFormat:@"%.1f%%", ((float)stat.games/(float)stat.total) * 100];
}

- (void)awakeFromNib {
    // Initialization code
}

- (void)setSelected:(BOOL)selected animated:(BOOL)animated {
    [super setSelected:selected animated:animated];

    // Configure the view for the selected state
}

@end
