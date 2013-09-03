---
layout: post
title: New KEYS operator implemented.
categories:
- Dev Diary
tags:
- features
- keys
- new operator
- operator
status: publish
type: post
published: true
---

Since I've started to develop on my spare time ( well, actually the spare time of my spare time XD ) a web admin tool for Gibson, i needed an operator which, given a prefix expression, would give me back a list of matching keys.
Of course this could be done using the [MGET](http://gibson-db.in/commands/mget.html) operator, but fetching from the socket all the data just to obtain the keys seemed a wasted, so i've implemented the [KEYS](http://gibson-db.in/commands/keys.html) operator, which will return just the list of matching keys as a REPL_KVAL response.  

So, if we have

    SET 0 app:counter:10 0
    SET 0 app:counter:11 23

And

    KEYS app:counter:

The response will be:

    0 => <STRING> app:counter:10
    1 => <STRING> app:counter:11
