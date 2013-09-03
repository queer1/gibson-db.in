---
layout: post
title: News news news!
categories:
- Dev Diary
tags:
- 32 bit
- 64 bit
- client
- daemon
- event
- interoperability
- libevent
- persistent connection
- phpdaemon
- server
status: publish
type: post
published: true
---

Only three days passed since the last post and a lot of new things happened, Gibson had a wonderful feedback from the open source community, people is starting to talk about it, to give suggestions, critics and help with bugs and code.

#### Persistent Connections

A **big** thank to [Antony Dovgal](https://github.com/tony2001) who helped me ( a lot ) to refactor and fix the php module [persistent connection feature](http://gibson-db.in/phpgibson.html#pconnect) providing a big patch, now everything is working perfectly well.

#### 32/64 bit Client/Server interoperability

*High five* to [Vasily Zorin](https://github.com/kakserpom) who [pointed out](https://groups.google.com/forum/#!topic/gibson-cache-server/ziTpZ8akM6I) that a 32 bit client couldn't communicate with a 64 bit server instance, providing suggestions. Today i've committed a patch which made clients and servers on different architectures fully interoperable.

#### phpDaemon Integration

Vasily is the lead developer of a great project, [phpDaemon](http://daemon.io/) which is an asynchronous server-side framework for web and network applications implemented in PHP. Starting from today Gibson is [fully integrated](https://github.com/kakserpom/phpdaemon/tree/master/PHPDaemon/Clients/Gibson) as one of its ( many ) client protocols ... again, *high five* dude!

#### New stats

Due to the above new features and fixes, three new stats were added.

* **total_connections**: The number of connections the server received since it was started.
* **total_requests**: The number of valid requests the server received since it was started.
* **reqs_per_client_avg**: Average number of requests per client.

When persistent connections are not used, the latter will be 1 of course, otherwise you will get an higher number.  
A huge thank to everyone who sent me emails, messages, suggestions and even critics ... thank you guys!
