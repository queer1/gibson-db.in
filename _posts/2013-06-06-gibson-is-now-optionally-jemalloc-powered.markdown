---
layout: post
title: Gibson is now (optionally) jemalloc powered!
categories:
- Dev Diary
tags:
- allocation
- allocator
- fragmentation
- jemalloc
- malloc
- memory
- virtual memory
- VSZ
status: publish
type: post
published: true
---

I've just pushed an importat experimental commit to the Gibson repository, it's been a while since i'm thinking about optimizing the memory overhead the standard malloc implementation and today i've come to the decision to start using [jemalloc](http://www.canonware.com/jemalloc/index.html "jemalloc memory allocator").  
**jemalloc** is a general-purpose scalable concurrent malloc(3) implementation, proven to be very fast and low on memory usage in multi threaded applications ... but can jemalloc help Gibson since [it's not multi threaded but multiplexed](http://gibson-db.in/documentation.html#scaling "Gibson is not multi threaded") ?  

So i started to make some ( very rough ) tests, creating step by step many objects inside the Gibson data structure and measuring the memory footprint with both malloc and jemalloc, the results follow.

With **malloc**:

          0 items : 30004
        100 items : 40316
       1000 items : 40448
      10000 items : 42296
     100000 items : 60116
    1000000 items : 238712

With **jemalloc**:

          0 items  : 45604
        100 items  : 57892
       1000 items  : 57892
      10000 items  : 57892
     100000 items  : 74276
    1000000 items : 234020


On the left side you see the number of objects allocated, on the right side you see the VSZ memory usage ( which has to be multiplied by PAGE_SIZE, usually 4096 bytes ).  
It's clear that with small amount of elements, malloc wins, since jemalloc probably ( i don't know the internals of jemalloc, so correct if i'm wrong ) is preallocating its memory buckets hence using much memory, but when the number of elements is higher ( which is the most realistic case ) jemalloc uses about 2% less of memory, and the value tends to be more stable than malloc's during a long uptime period, moreover jemalloc is known to reduce the [memory fragmentation](http://en.wikipedia.org/wiki/Fragmentation_(computing) "Memory Fragmentation") problem, which is good!  

Therefore i've modified the code to optionally use jemalloc and i've started to test it on my own server, if the real world results will be the same, probably i'm gonna integrate jemalloc as a builtin module instead of an optional dependency.  
Just a note, on my Debian Squeeze there's no libjemalloc-dev precompiled package in the repositories, so i had to compile it myself:

    wget http://www.canonware.com/download/jemalloc/jemalloc-3.4.0.tar.bz2
    tar xvf jemalloc-3.4.0.tar.bz2
    cd jemalloc
    ./configure --prefix=/usr
    make
    sudo make install

Then i've pulled Gibson from the repository and [compiled it as usual](http://gibson-db.in/download.html "Download and compile Gibson") :)

Since this is the first time i benchmark such things and use an alternative memory allocator, if you find i said something wrong/stupid please leave a comment below, tnx.