---
layout: default
title: MUNLOCK Command Reference 
---

# MUNLOCK

Remove the lock on keys verifying the given prefix.  

* * *

#### Syntax

        MUNLOCK <prefix>  

#### Arguments

* **key** ( string ) The key prefix to use as expression.

#### Example

       SET 0 foo bar
  
       SET 0 fuu bar
  
       MLOCK f 30
  
       MUNLOCK f
  
