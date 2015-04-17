//
//  MenuViewController.m
//  NURF Trynd
//
//  Created by James Glenn on 4/17/15.
//  Copyright (c) 2015 Rockfish. All rights reserved.
//

#import "MenuViewController.h"
#import "AppDelegate.h"
#import "Region.h"

@interface MenuViewController () <UITableViewDataSource, UITableViewDelegate>
@property (weak, nonatomic) IBOutlet UITableView *tableView;
@property (nonatomic, strong) NSArray *regions;
@end

@implementation MenuViewController

#pragma mark - UITableView Delegate/DataSource
- (NSInteger)tableView:(UITableView *)tableView numberOfRowsInSection:(NSInteger)section {
    return self.regions.count;
}

- (UITableViewCell *)tableView:(UITableView *)tableView cellForRowAtIndexPath:(NSIndexPath *)indexPath {
    UITableViewCell *cell = [tableView dequeueReusableCellWithIdentifier:@"RegionTableViewCell" forIndexPath:indexPath];
    
    Region *region = self.regions[indexPath.row];
    cell.textLabel.text = [NSString stringWithFormat:@"%@ (%@)", region.name, region.abbreviation.uppercaseString];
    
    if (region == [AppDelegate sharedDelegate].selectedRegion) {
        cell.textLabel.textColor = [UIColor redColor];
    } else {
        cell.textLabel.textColor = [UIColor whiteColor];
    }

    
    return cell;
}

- (void)tableView:(UITableView *)tableView didSelectRowAtIndexPath:(NSIndexPath *)indexPath {
    [tableView deselectRowAtIndexPath:indexPath animated:YES];
    Region *region = self.regions[indexPath.row];
    
    [AppDelegate sharedDelegate].selectedRegion = region;
    [tableView reloadData];
    
    [[AppDelegate sharedDelegate].drawerViewController closeDrawerWithSide:JVFloatingDrawerSideLeft animated:YES completion:nil];
}

- (void)viewDidLoad {
    [super viewDidLoad];
    // Do any additional setup after loading the view.
    [self loadRegions];
}

- (void)loadRegions {
    self.regions = [[AppDelegate sharedDelegate].regions copy];
}

- (void)didReceiveMemoryWarning {
    [super didReceiveMemoryWarning];
    // Dispose of any resources that can be recreated.
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
