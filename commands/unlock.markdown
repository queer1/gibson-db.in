---
layout: default
title: UNLOCK Command Reference 
---

# UNLOCK

Remove the lock from the given key.  

* * *

#### Syntax

        UNLOCK <key>  

#### Arguments

* **key** ( string ) The key.

#### Example

       SET 0 foo bar
  
       LOCK foo 30
  
       UNLOCK foo
  
