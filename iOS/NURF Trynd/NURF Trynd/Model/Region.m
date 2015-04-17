//
//  Region.m
//  NURF Trynd
//
//  Created by James Glenn on 4/17/15.
//  Copyright (c) 2015 Rockfish. All rights reserved.
//

#import "Region.h"

@implementation Region

+ (instancetype)regionWithDict:(NSDictionary *)dict {
    Region *region = [Region new];
    region.name = dict[@"name"];
    region.abbreviation = dict[@"abbreviation"];
    
    return region;
}

@end
