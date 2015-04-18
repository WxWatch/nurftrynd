//
//  TrendingViewController.m
//  NURF Trynd
//
//  Created by James Glenn on 4/1/15.
//  Copyright (c) 2015 James Glenn. All rights reserved.
//

#import "TrendingViewController.h"
#import "ChampionManager.h"
#import "MBProgressHUD.h"
#import "GetPlayedChampionsService.h"
#import "PlayedStat.h"
#import "TrendingTableViewCell.h"
#import "AppDelegate.h"

@interface TrendingViewController ()
@property (nonatomic, strong) NSArray *trends;
@end

@implementation TrendingViewController

#pragma mark - UITableView Delegate/DataSource
- (CGFloat)tableView:(UITableView *)tableView heightForRowAtIndexPath:(NSIndexPath *)indexPath {
    return 60.0f;
}

- (NSInteger)tableView:(UITableView *)tableView numberOfRowsInSection:(NSInteger)section {
    return self.trends.count;
}

- (UITableViewCell *)tableView:(UITableView *)tableView cellForRowAtIndexPath:(NSIndexPath *)indexPath {
    TrendingTableViewCell *cell = [tableView dequeueReusableCellWithIdentifier:NSStringFromClass([TrendingTableViewCell class]) forIndexPath:indexPath];
    
    PlayedStat *stat = self.trends[indexPath.row];
    [cell setupWithStat:stat];
    
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
    
    self.title = [NSString stringWithFormat:@"Games Played - %@", regionTitle];
    
    MBProgressHUD *hud = [MBProgressHUD showHUDAddedTo:self.view animated:YES];
    [self.view bringSubviewToFront:hud];
    hud.mode = MBProgressHUDModeIndeterminate;
    hud.labelText = @"Loading";
    
    [[GetPlayedChampionsService new] getPlayedStatsWithRegion:[AppDelegate sharedDelegate].selectedRegion withSuccess:^(RLMResults *stats) {
        NSLog(@"Success");
        
        NSMutableArray *temp = [NSMutableArray new];
        for (PlayedStat *stat in [stats sortedResultsUsingProperty:@"games" ascending:NO]) {
            [temp addObject:stat];
        }

        self.trends = [NSArray arrayWithArray:temp];
        
        dispatch_async(dispatch_get_main_queue(), ^{
            [hud hide:YES];
            [self.tableView reloadData];
        });
    } andFailure:^(NSError *error) {
        NSLog(@"Fail");
        [hud hide:YES];
    }];
}

/*
#pragma mark - Navigation

// In a storyboard-based application, you will often want to do a little preparation before navigation
- (void)prepareForSegue:(UIStoryboardSegue *)segue sender:(id)sender {
    // Get the new view controller using [segue destinationViewController].
    // Pass the selected object to the new view controller.
}
*/

@end
