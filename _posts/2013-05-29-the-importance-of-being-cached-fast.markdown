---
layout: post
title: The importance of being cached fast
categories:
- Tips &amp; Tricks
tags:
- cache
- igbinary
- json
- optimization
- pecl
- performance
- performances
- php
- serialization
- serialize
status: publish
type: post
published: true
---

When we talk about a cache system, whatever you choose to use, two are the main factors to keep in consideration, **speed** and **size**.
You can find documentation and benchmarks about the two or three cache systems you want to try, but profiling your PHP cache policies and methods is another thing.
Even if you use the best system out there, with best performances and builtin compression, your bottleneck could be the way you decide to store objects.
Usually people use PHP serialization features, but is this really the best solution ?

There's an [interesting article](http://codepoets.co.uk/2011/php-serialization-igbinary/) of David Goodwin about this, results are pretty self explainatory:

### JSON

* JSON encoded in 2.180496931076 seconds
* JSON decoded in 9.8368630409241 seconds
* serialized "String" size : 13993

### Native PHP

* PHP serialized in 2.9125759601593 seconds
* PHP unserialized in 6.4348418712616 seconds
* serialized "String" size : 20769

### Igbinary

* _WIN_ igbinary serialized in 1.6099879741669 seconds
* _WIN_ igbinrary unserialized in 4.7737920284271 seconds
* _WIN_ serialized "String" Size : 4467

And [this](https://gist.github.com/jedisct1/896204) Frank Denis snippet shows that igbinary wins on data size too:

* php serialize(): 33,777,792 bytes
* php igbinary: 18,757,571 bytes
* php json_encode: 19,777,781 bytes

So, choose carefully your approach on caching and don't be scared to try new approaches! :)