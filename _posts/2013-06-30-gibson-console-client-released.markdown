---
layout: post
title: Gibson Console Client released.
categories:
- Dev Diary
tags:
- client
- console
- console client
- debug
- gibson client
- gibson console client
- libgibsonclient
- library
- utility
status: publish
type: post
published: true
---

Just a quick note to inform you that the first Gibson console client was just released. I needed it to debug my local Gibson instance so i guess someone else will find it useful :)

    To download and compile it:
    git clone https://github.com/evilsocket/libgibsonclient.git
    git submodule init
    git submodule update
    cmake .
    make
    sudo make install
    
The documentation is [here](http://gibson-db.in/documentation.html#cclient).
