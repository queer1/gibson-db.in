---
layout: default
title: MTTL Command Reference 
---

# MTTL

Set the TTL for keys verifying the given prefix.  

* * *

#### Syntax

        MTTL <prefix> <ttl>  

#### Arguments

* **key** ( string ) The key prefix to use as expression.
* **ttl** ( integer ) The TTL in seconds.

#### Example

       SET 0 foo bar
  
       SET 0 fuu bar
  
       MTTL f 10 // Now both foo and fuu have a 10 seconds ttl
  

#### Notes

* This operator will fail for LOCKed items.
