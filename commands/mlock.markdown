---
layout: default
title: MLOCK Command Reference 
---

# MLOCK

Prevent keys verifying the given prefix from being modified for a given amount of seconds.  

* * *

#### Syntax

        MLOCK <prefix> <time>  

#### Arguments

* **prefix** ( string ) The key prefix to use as expression.
* **time** ( integer ) The lock period in seconds.

#### Example

       SET 0 foo bar
  
       SET 0 fuu bur
  
       MLOCK f 30
  
       DEL foo // this will fail since both foo and fuu are now locked
  
