# Introduction

URF Trynd is a way to view player perception of champion strength in URF mode. It accomplishes this by allowing the user to see trynds in which champions are being picked, which are being banned, and which are neither. At first, this project attempted to show the URF-meta, however, the URF-meta always consisted of 100% pick rates for Urf the Manatee, who never lost a single game, therefore we altered our project to show Trynds in URF.

# So...what is this?
URF Trynd is the combination of a simple webpage, an API, and an iOS app to display URF data, specifically champion pick and ban rate.

# Where can I see it?
The webpage can be found at http://lolmobile.net/urftrynd/
The API endpoints are contained at http://lolmobile.net/challenge/api/v1/played and http://lolmobile.net/challenge/api/v1/banned
The iOS application video can be viewed [here](http://youtube.com)

# API Details
For simplicity (and time-sake), the endpoints accept one 'region' parameter, which accepts any valid League of Legends region.
e.g. http://lolmobile.net/challenge/api/v1/played?region=na

Specifying no region will return results for every region combined (e.g. World)

# So...what's next?
There are many possibilities for next steps with this suite of applications and tools. Some of the more interesting ones are:
- URF/t: Visualizations of champion popularity as URF mode progressed through its lifetime. When did the OP picks REALLY start getting picked?
- URF Shop: Which items were being built the most? Which items just weren't popular in URF?
- URF Stat Shockers: Which champions dealt the most DPS? Who was the king (or queen) (or banana queen) of healing? Who was the URF mega-damage-sponge?
- Many, many, many more than my mind could even comprehend.

© James Glenn, 2015.
URF Trynd/LoL Mobile isn't endorsed by Riot Games and doesn't reflect the views or opinions of Riot Games or anyone officially involved in producing or managing League of Legends. League of Legends and Riot Games are trademarks or registered trademarks of Riot Games, Inc. League of Legends © Riot Games, Inc.