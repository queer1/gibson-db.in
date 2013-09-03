---
layout: post
title: What is Gibson cache server and why do i need it
categories:
- Dev Diary
tags:
- cache
- data
- database
- db
- free time
- gibson
- key value
- optimizations
- performance
- store
- structure
- time complexity
- tree
status: publish
type: post
published: true
---

Well, what is better than the explaination of the reason of a project to start the project development blog ? :)  

First of all let me introduce myself, I'm Simone ( aka evilsocket ), an italian developer with [many open source projects](http://github.com/evilsocket "My GitHub page.") in the wild, in my free time ( which shamefully it's very little recently ) i manage three websites, my [personal blog](http://www.evilsocket.net "My personal blog.") ( in my language ), a [social source code snippet aggregator](http://www.emoticode.net "EmotiCODE") and finally the blog of another project of mine ( an Android app ), [dSploit](http://www.dsploit.net/ "dSploit").

I have no big traffic, let's say something around 3/4000 unique visitors/day, but my dedicated server is cheap ( hence not so powerful ) and i have to optimize my web applications to work flawlessy on big data sets ( emoticode.net has something like 50.000 snippets, multiply it by N for every keyword relation stored on the database ), so the obvious conclusion is that i needed to implement a cache mechanism to store volatile data for a given time-to-live, reducing the db workload.
The first version of emoticode used to have a file cache system, which worked pretty well until it reached  more and more contents, at that point the I/O became the main bottleneck of the system and i started to think to alternative solutions ... indeed, in-memory caching was the first thing came to my mind, so i started to search for pre made solutions ( i like to write code, but i don't enjoy reinventing the wheel every time :D ).
I've used **memcache** in the past, and i've found it kinda primitive for what i needed to do, on the other hand solutions like **Redis** were way too much full of features i didn't need, and i like the **keep-it-simple** pragmatism.  

So, due to some free hours i had in the evening, i started to code **Gibson**.  

Normal key-value stores ( memcache, redis, etc ) uses a [hash table](http://en.wikipedia.org/wiki/Hash_table) as their main data structure, so every key is hashed with a specific algorithm and the resulting hash is used to identify the given value in memory. This approach, although very fast, doesn't allow the user to execute globbing expressions/selections on a given (multiple) keyset, thus resulting on a pure one-by-one access paradigm.
Gibson is different, it's implemented on a **tree based structure** allowing the user to perform operations on [multiple key sets](http://gibson-db.in/phpgibson.html#mset) using a prefix expression achieving the same performance grades.  

Let us say i wanted to keep ( and this is only the simpler example i could do ) a visit counter for each page of emoticode in memory, and increment it on every user visit. Now, what if i wanted to increment ( for instance ) the counters of every url in the /php/ category ( when an user visited the category archive ) ?
Usually you have two options here, looping each url in the category and incrementing its counter with one-by-one operations ( this is not doable with 50K items stored on a db ), or keeping another counter for the /php/ category itself and increment it both on every listing visit and single url visit ( making two cache INC operations per visit instead of one ).
Due to its nature, this is pretty easy with Gibson, just use the MINC operator with the /php/ prefix  

And you have done! One INC on every /php/ url and one MINC on every listing ( in this example i'm talking about categories, but that could be a keyword/tag too of course ).
The time complexity of Gibson data structure is the same of a hash table, it just depends on the key length ( correct me if i'm wrong, i'm no expert here ), while a hash algorithm would create an ( almost ) unique hash of the key, the Gibson tree structure will just traverse the nodes corresponding to the key characters ... that's it!  

I have a fast and [easily scalable](http://gibson-db.in/documentation.html#scaling "Make Gibson scale") memory cache server with something different from other alternatives :)
**A couple of notes.**  

I'm italian, so English is not my primary language ... forgive me for my errors XD  
I'm developing Gibson just for fun, but i really believe it can become a big thing, so if you have any suggestion please feel free to drop a line here ;)