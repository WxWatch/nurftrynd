//
//  AppDelegate.h
//  NURF Trynd
//
//  Created by James Glenn on 4/1/15.
//  Copyright (c) 2015 James Glenn. All rights reserved.
//

#import <UIKit/UIKit.h>
#import "JVFloatingDrawerViewController.h"
#import "Region.h"

@interface AppDelegate : UIResponder <UIApplicationDelegate>

+ (instancetype)sharedDelegate;

@property (strong, nonatomic) UIWindow *window;
@property (nonatomic, strong) JVFloatingDrawerViewController *drawerViewController;
@property (nonatomic, strong) NSArray *regions;
@property (nonatomic, strong) Region *selectedRegion;


@end

