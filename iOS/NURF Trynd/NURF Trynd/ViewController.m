//
//  ViewController.m
//  NURF Trynd
//
//  Created by James Glenn on 4/1/15.
//  Copyright (c) 2015 James Glenn. All rights reserved.
//

#import "ViewController.h"
#import "TrendingViewController.h"
#import "JVFloatingDrawerSpringAnimator.h"
#import "AppDelegate.h"

@interface ViewController ()

@end

@implementation ViewController

- (void)toggleMenu {
    [self openDrawerWithSide:JVFloatingDrawerSideLeft animated:YES completion:nil];
}

- (void)viewDidLoad {
    [super viewDidLoad];
    // Do any additional setup after loading the view, typically from a nib.
    [AppDelegate sharedDelegate].drawerViewController = self;
    
    self.leftViewController = [self.storyboard instantiateViewControllerWithIdentifier:@"MenuViewController"];
    self.centerViewController = [self.storyboard instantiateViewControllerWithIdentifier:@"TabBarViewController"];
    self.animator = [JVFloatingDrawerSpringAnimator new];
    
    self.backgroundImage = [UIImage imageNamed:@"transferback"];
    
    self.navigationItem.leftBarButtonItem = [[UIBarButtonItem alloc] initWithTitle:@"|||" style:UIBarButtonItemStylePlain target:self action:@selector(toggleMenu)];
}

- (void)didReceiveMemoryWarning {
    [super didReceiveMemoryWarning];
    // Dispose of any resources that can be recreated.
}

@end
