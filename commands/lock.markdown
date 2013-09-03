---
layout: default
title: LOCK Command Reference 
---

# LOCK

Prevent the given key from being modified for a given amount of seconds.  

* * *

#### Syntax

        LOCK <key> <time>  

#### Arguments

* **key** ( string ) The key.
* **time** ( integer ) The time in seconds to lock the item.

#### Example

       SET 0 foo bar
  
       LOCK foo 30
  
       DEL foo // this will fail since foo is now locked
  
