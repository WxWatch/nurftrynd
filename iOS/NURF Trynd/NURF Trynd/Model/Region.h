//
//  Region.h
//  NURF Trynd
//
//  Created by James Glenn on 4/17/15.
//  Copyright (c) 2015 Rockfish. All rights reserved.
//

#import <Foundation/Foundation.h>

@interface Region : NSObject

+ (instancetype)regionWithDict:(NSDictionary*)dict;

@property (nonatomic, strong) NSString *abbreviation;
@property (nonatomic, strong) NSString *name;

@end
