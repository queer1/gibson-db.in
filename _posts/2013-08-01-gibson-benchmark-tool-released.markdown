---
layout: post
title: Gibson benchmark tool released.
categories: []
tags:
- benchmark
- client
- concurrency
- event
- i/o
- non-blocking
status: publish
type: post
published: true
---

A [new benchmark tool](https://github.com/evilsocket/gibson-benchmark) has been released, it's written in node.js since it's a non-blocking, event driven, concurrent clients simulator.

### Usage

The command line options are pretty self explainatory.

    --help      Show the help menu and exit.                                     
    --dns       The connection string, default is unix:///var/run/gibson.sock.   
    --clients   The number of concurrent clients to use, default is 50.          
    --requests  The number of total requests to send per client, default 10000.  
    --timeout   Socket milli seconds timeout, default to 0 ( no timeout ).       
    --key       The key to create before running the benchmark, default is "foo".
    --value     The value to use for --key argument, default is "gibsoniscool".  
    --operator  The operator to benchmark, default is "GET foo"

### Examples

Simply benchmark a 'GET foo' operation with 50 concurrent clients, each one executing 10000 operations:

    node benchmark.js

Connect to a local tcp Gibson instance using a 100ms timeout:

    node benchmark.js --dns "tcp://127.0.0.1:10128" --timeout 100

Benchmark the PING operator:

    node benchmark.js --operator PING
