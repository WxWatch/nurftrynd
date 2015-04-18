//
//  BannedViewController.m
//  NURF Trynd
//
//  Created by James Glenn on 4/17/15.
//  Copyright (c) 2015 Rockfish. All rights reserved.
//

#import "BannedViewController.h"
#import "ChampionManager.h"
#import "MBProgressHUD.h"
#import "GetBannedChampionsService.h"
#import "BannedStat.h"
#import "TrendingTableViewCell.h"
#import "AppDelegate.h"

@interface BannedViewController ()
@property (nonatomic, strong) NSArray *bans;

@end

@implementation BannedViewController

#pragma mark - UITableView Delegate/DataSource
- (CGFloat)tableView:(UITableView *)tableView heightForRowAtIndexPath:(NSIndexPath *)indexPath {
    return 60.0f;
}

- (NSInteger)tableView:(UITableView *)tableView numberOfRowsInSection:(NSInteger)section {
    return self.bans.count;
}

- (UITableViewCell *)tableView:(UITableView *)tableView cellForRowAtIndexPath:(NSIndexPath *)indexPath {
    TrendingTableViewCell *cell = [tableView dequeueReusableCellWithIdentifier:NSStringFromClass([TrendingTableViewCell class]) forIndexPath:indexPath];
    
    BannedStat *stat = self.bans[indexPath.row];
    [cell setupWithBan:stat];
    
    return cell;
}

- (void)viewDidLoad {
    [super viewDidLoad];
    // Do any additional setup after loading the view.
    [[NSNotificationCenter defaultCenter] addObserver:self selector:@selector(loadData) name:@"RegionSelected" object:nil];
    
    [self loadData];
}

- (void)didReceiveMemoryWarning {
    [super didReceiveMemoryWarning];
    // Dispose of any resources that can be recreated.
}

- (void)loadData {
    Region *region = [AppDelegate sharedDelegate].selectedRegion;
    NSString *regionTitle = @"World";
    if (region) {
        regionTitle = region.abbreviation.uppercaseString;
    }
    
    self.title = [NSString stringWithFormat:@"Games Banned - %@", regionTitle];
    
    MBProgressHUD *hud = [MBProgressHUD showHUDAddedTo:self.view animated:YES];
    [self.view bringSubviewToFront:hud];
    hud.mode = MBProgressHUDModeIndeterminate;
    hud.labelText = @"Loading";
    
    [[GetBannedChampionsService new] getBannedStatsWithRegion:[AppDelegate sharedDelegate].selectedRegion withSuccess:^(RLMResults *stats) {
        NSLog(@"Success");
        
        NSMutableArray *temp = [NSMutableArray new];
        for (PlayedStat *stat in [stats sortedResultsUsingProperty:@"games" ascending:NO]) {
            [temp addObject:stat];
        }
        
        self.bans = [NSArray arrayWithArray:temp];
        
        dispatch_async(dispatch_get_main_queue(), ^{
            [hud hide:YES];
            [self.tableView reloadData];
        });
    } andFailure:^(NSError *error) {
        NSLog(@"Fail");
        [hud hide:YES];
    }];
}

@end
