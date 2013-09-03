---
layout: default
title: Compilation and Installation
---

# Compilation and Installation

Gibson is still hosted as source code release on Github, in order to run it you will have to compile sources, therefore you will need **git**, **cmake**, **gcc** and **build-essential** packages installed on your computer.

* * *

#### Clone/Download

You have two options to obtain the source code, one is cloning the github repository using git:

    git clone https://github.com/evilsocket/gibson.git

Or you can download the source code archive [from here](https://github.com/evilsocket/gibson/archive/unstable.zip).

#### Compiling

Once you got the source code, all you have to do is compile Gibson, the process is pretty straightforward.

    $ cd gibson
    $ cmake . [compilation options]
    $ make
    # make install

Where **compilation options** might be:

    -DPREFIX=/your/custom/prefix

To use a different installation prefix rather than _/usr_ .

    -DWITH_DEBUG=1

To compile with debug symbols and without optimizations ( for devs ).

    -DWITH_JEMALLOC=1

To use the [jemalloc memory allocator](/blog/gibson-is-now-optionally-jemalloc-powered.html) instead of the standard one.

If you want to edit the default configuration, please refer to the [documentation](/documentation.html).

