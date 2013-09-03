---
layout: post
title: A matter of speed ( Redis vs Gibson GET/SET benchmark )
categories:
- Dev Diary
tags:
- benchmark
- gibson
- redis
- request
- requests
- requests per second
status: publish
type: post
published: true
---

The pc is an **Intel(R) Core(TM) i3-2130** CPU @ **3.40GHz** with **8GB **of RAM, running **Debian Squeeze**, i'll just let the results talk.

**Redis** GET/SET Test ( Redis v2.6.13, 1 client, 100K operations ) :

    $ redis-benchmark -c 1 -n 100000 -q -t SET

    SET: 51519.84 requests per second

    $ redis-benchmark -c 1 -n 100000 -q -t GET

    GET: 49212.60 requests per second

**Gibson** [GET/SET Test](http://www.emoticode.net/c/gibson-setget-benchmark-test.html) ( 1 client, 100K operations ):

    @ Created 100000 / 100000 in 1216ms

    -- **82236.842105** Req/s

    @ Verified : 100000 / 100000 in 1145ms

    -- **87336.244541** Req/s

Should i add anything else ? :)
