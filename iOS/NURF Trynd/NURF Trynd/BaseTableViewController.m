//
//  BaseTableViewController.m
//  NURF Trynd
//
//  Created by James Glenn on 4/17/15.
//  Copyright (c) 2015 Rockfish. All rights reserved.
//

#import "BaseTableViewController.h"
#import "AppDelegate.h"

@interface BaseTableViewController ()

@end

@implementation BaseTableViewController

- (void)toggleMenu {
    [[AppDelegate sharedDelegate].drawerViewController openDrawerWithSide:JVFloatingDrawerSideLeft animated:YES completion:nil];
}

- (void)viewDidLoad {
    [super viewDidLoad];
    // Do any additional setup after loading the view.
    self.navigationItem.leftBarButtonItem = [[UIBarButtonItem alloc] initWithTitle:@"Region" style:UIBarButtonItemStylePlain target:self action:@selector(toggleMenu)];
    
}

- (void)didReceiveMemoryWarning {
    [super didReceiveMemoryWarning];
    // Dispose of any resources that can be recreated.
}

@end
