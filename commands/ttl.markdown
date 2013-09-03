---
layout: default
title: TTL Command Reference 
---

# TTL

Set the TTL of a key.  

* * *

#### Syntax

        TTL <key> <ttl>  

#### Arguments

* **key** ( string ) The key.
* **ttl** ( integer ) The TTL in seconds.

#### Example

       SET 0 foo bar
  
       TTL foo 10 // Now 'foo' has a 10 seconds ttl
  

#### Notes

* This operator will fail for LOCKed items.
