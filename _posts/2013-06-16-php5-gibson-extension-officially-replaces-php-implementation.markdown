---
layout: post
title: PHP5 Gibson extension officially replaces PHP implementation.
categories:
- Dev Diary
tags:
- extension
- gibson
- native
- official
- pecl
- php
- release
- test
- test phase
- testing
status: publish
type: post
published: true
---

These days i'm developing the [PHP5 native extension](http://gibson-db.in/blog/php-extension-is-on-the-way.html) for Gibson, which after a couple of commits solving [binary safety](https://github.com/evilsocket/gibson/commit/3ed25b87cd4efafd7ae8d7111798ee7989786a68) and some other [minor bug](https://github.com/evilsocket/gibson/commit/a561185425c2ef05a30a070578880a85c30881f2), is ready to be tested in a real world environment.  
Hence, i've deleted the PHP implementation of the class and i've started using the extension on this server, with great results so far!
Once i will be sure everything is ok, i'll finally release the 1.0.0 stable both of the server and the php extension, in the mean time you can start reading the official documentation [here](http://gibson-db.in/phpgibson.html).

PS: A big tnx to [Alessio Dalla Piazza](http://clshack.com/) for helping me during this test phase!
