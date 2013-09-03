---
layout: post
title: PHP Gibson extension now persistent connections powered.
categories:
- Dev Diary
tags:
- connection
- pconnect
- persistent connection
- php
status: publish
type: post
published: true
---

After a lot of work ( most of it due to my low experience with native PHP extensions ) I am happy to announce that the PHP Gibson extension is now capable of using persistent connections!
If you ever used any *_pconnect function you know what I'm talking about, for other people let me clear it out a little bit.
If you create a Gibson instance and then call **connect** inside your PHP page, the socket you've just created will live only for this request and, moreover, if you call connect multiple times you will create multiple connections.
With persistent connections, even if you call **pconnect** ten times, you will only have one connection, even after the request since a persistent object will live as far as the server process lives.  

Here's the [documentation](http://gibson-db.in/phpgibson.html#pconnect).
