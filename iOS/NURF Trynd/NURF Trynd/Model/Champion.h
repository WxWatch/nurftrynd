//
//  Champion.h
//  NURF Trynd
//
//  Created by James Glenn on 4/17/15.
//  Copyright (c) 2015 Rockfish. All rights reserved.
//

#import <Realm/Realm.h>
#import "Image.h"

@interface Champion : RLMObject
@property NSInteger id;
@property Image *image;
@property NSString *key;
@property NSString *name;
@property NSString *title;
@end

// This protocol enables typed collections. i.e.:
// RLMArray<Champion>
RLM_ARRAY_TYPE(Champion)
