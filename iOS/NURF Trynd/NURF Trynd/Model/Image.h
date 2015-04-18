//
//  Image.h
//  NURF Trynd
//
//  Created by James Glenn on 4/17/15.
//  Copyright (c) 2015 Rockfish. All rights reserved.
//

#import <Realm/Realm.h>

@interface Image : RLMObject
@property NSString *full;
@property NSString *group;
@property NSInteger h;
@property NSString *sprite;
@property NSInteger w;
@property NSInteger x;
@property NSInteger y;
@end

// This protocol enables typed collections. i.e.:
// RLMArray<Image>
RLM_ARRAY_TYPE(Image)
