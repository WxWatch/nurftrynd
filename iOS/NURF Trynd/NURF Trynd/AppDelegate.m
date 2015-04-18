//
//  AppDelegate.m
//  NURF Trynd
//
//  Created by James Glenn on 4/1/15.
//  Copyright (c) 2015 James Glenn. All rights reserved.
//

#import "AppDelegate.h"
#import "Region.h"
#import "AFNetworking.h"
#import <Realm/Realm.h>
#import "Champion.h"

#define kNotificationRegionChanged @"kNotificatonRegionChanged"

@interface AppDelegate ()

@end

@implementation AppDelegate

+ (instancetype)sharedDelegate {
    return (AppDelegate*)[[UIApplication sharedApplication] delegate];
}

- (void)setSelectedRegion:(Region *)selectedRegion {
    _selectedRegion = selectedRegion;
    [[NSNotificationCenter defaultCenter] postNotificationName:kNotificationRegionChanged object:nil];
}

- (void)populateRegions {
    NSString *filePath = [[NSBundle mainBundle] pathForResource:@"Regions" ofType:@"plist"];
    NSArray *regionArray = [NSArray arrayWithContentsOfFile:filePath];
    NSMutableArray *tempRegionArray = [NSMutableArray new];
    for (NSDictionary *regionDict in regionArray) {
        Region *region = [Region regionWithDict:regionDict];
        [tempRegionArray addObject:region];
    }
    
    self.regions = [tempRegionArray sortedArrayUsingComparator:^NSComparisonResult(Region *obj1, Region *obj2) {
        NSString *abbr1 = obj1.abbreviation;
        NSString *abbr2 = obj2.abbreviation;
        
        return [abbr1 compare:abbr2];
    }];
}


- (BOOL)application:(UIApplication *)application didFinishLaunchingWithOptions:(NSDictionary *)launchOptions {
    // Override point for customization after application launch.
    
    // Setup appearance
    [[UINavigationBar appearance] setBarStyle:UIBarStyleBlack];
    [[UINavigationBar appearance] setTintColor:[UIColor whiteColor]];
    [[UITabBar appearance] setBarStyle:UIBarStyleBlack];
    [[UITabBar appearance] setTintColor:[UIColor whiteColor]];
    
    // Populate regions
    [self populateRegions];
    
    
//    //Used to populate the championinfo realm the first time :D
//    AFHTTPRequestOperationManager *mang = [[AFHTTPRequestOperationManager alloc] initWithBaseURL:[NSURL URLWithString:@"https://global.api.pvp.net/"]];
//    mang.operationQueue = [[NSOperationQueue alloc] init];
//    mang.requestSerializer = [AFJSONRequestSerializer serializer];
//    mang.responseSerializer = [AFJSONResponseSerializer serializer];
//    
//    NSString *url = @"https://global.api.pvp.net/api/lol/static-data/na/v1.2/champion";
//    NSDictionary *params = @{ @"champData": @"image",
//                              @"api_key": @"KEY" };
//    NSError *error;
//    NSMutableURLRequest *request = [mang.requestSerializer requestWithMethod:@"GET" URLString:url parameters:params error:&error];
//    
//    AFHTTPRequestOperation *operation = [mang HTTPRequestOperationWithRequest:request success:^(AFHTTPRequestOperation *operation, id responseObject) {
//        NSLog(@"Success");
//        NSArray *champs = [responseObject[@"data"] allValues];
//        NSLog(@"%@", champs);
//        
//        RLMRealm *realm = [RLMRealm defaultRealm];
//        [realm beginWriteTransaction];
//        for (NSDictionary *champ in champs) {
//            [Champion createInDefaultRealmWithObject:champ];
//        }
//        [realm commitWriteTransaction];
//
//        
//    } failure:^(AFHTTPRequestOperation *operation, NSError *error) {
//        NSLog(@"Failure");
//    }];
//    
//    [mang.operationQueue addOperation:operation];
    
    
    return YES;
}

- (void)applicationWillResignActive:(UIApplication *)application {
    // Sent when the application is about to move from active to inactive state. This can occur for certain types of temporary interruptions (such as an incoming phone call or SMS message) or when the user quits the application and it begins the transition to the background state.
    // Use this method to pause ongoing tasks, disable timers, and throttle down OpenGL ES frame rates. Games should use this method to pause the game.
}

- (void)applicationDidEnterBackground:(UIApplication *)application {
    // Use this method to release shared resources, save user data, invalidate timers, and store enough application state information to restore your application to its current state in case it is terminated later.
    // If your application supports background execution, this method is called instead of applicationWillTerminate: when the user quits.
}

- (void)applicationWillEnterForeground:(UIApplication *)application {
    // Called as part of the transition from the background to the inactive state; here you can undo many of the changes made on entering the background.
}

- (void)applicationDidBecomeActive:(UIApplication *)application {
    // Restart any tasks that were paused (or not yet started) while the application was inactive. If the application was previously in the background, optionally refresh the user interface.
}

- (void)applicationWillTerminate:(UIApplication *)application {
    // Called when the application is about to terminate. Save data if appropriate. See also applicationDidEnterBackground:.
}

@end
