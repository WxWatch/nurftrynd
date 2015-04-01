//
//  ViewController.m
//  NURF Trynd
//
//  Created by James Glenn on 4/1/15.
//  Copyright (c) 2015 Rockfish. All rights reserved.
//

#import "ViewController.h"
#import "TrendingViewController.h"
#import "JVFloatingDrawerSpringAnimator.h"

@interface ViewController ()

@end

@implementation ViewController

- (void)toggleMenu {
    [self openDrawerWithSide:JVFloatingDrawerSideLeft animated:YES completion:nil];
}

- (void)viewDidLoad {
    [super viewDidLoad];
    // Do any additional setup after loading the view, typically from a nib.
    self.leftViewController = [UIViewController new];
    self.centerViewController = [self.storyboard instantiateViewControllerWithIdentifier:@"TrendingViewController"];
    self.animator = [JVFloatingDrawerSpringAnimator new];
    
    self.navigationItem.leftBarButtonItem = [[UIBarButtonItem alloc] initWithTitle:@"|||" style:UIBarButtonItemStylePlain target:self action:@selector(toggleMenu)];
}

- (void)didReceiveMemoryWarning {
    [super didReceiveMemoryWarning];
    // Dispose of any resources that can be recreated.
}

@end
