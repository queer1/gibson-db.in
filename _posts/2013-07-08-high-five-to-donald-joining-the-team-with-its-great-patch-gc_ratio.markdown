---
layout: post
title: High five to Donald joining the team with his great patch ( gc_ratio ) !
categories:
- Dev Diary
tags:
- branch
- dev
- dev team
- developer
- donald
- donald adu-poku
- gc_ratio
- ghana
- join
- memory
- patch
- team
status: publish
type: post
published: true
---

While the project is growing ( node.js and python clients being developed from people around the globe ) and getting visibility on github, a new developer today officially joined the team with a big patch introducing a whole new major feature ( and a big enhancement to how Gibson handles memory on limit conditions ).  

[Donald Adu-Poku](https://plus.google.com/117558553850012816937/) aka [dnldd](https://github.com/dnldd), is a game developer from Ghana, with a strong background in C developing, math and code optimization ( you know, game engines are not trivial to code :D ).  
Since the first time Donald contacted me on G+, i suddenly noticed his professionalism and meticulousness, considering he became quite familiar with Gibson code base in a couple of days!  

Today I've merged his patch which introduced the new **gc_ratio** configuration directive.  
When server gets out of memory ( **max_memory** threshold is reached ), data that is not being accessed in this amount of time ( i.e. gc_ratio 1h = data that is not being accessed in the last hour ) get deleted to release memory for the server.
This means higher server realiability and smarter memory usage in limit conditions.

So, **high five** for Donald, dude you did a great job!
