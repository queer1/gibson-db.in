---
layout: default
title: MSET Command Reference 
---

# MSET

Set the value for keys verifying the given prefix.  

* * *

#### Syntax

        MSET <prefix> <value>  

#### Arguments

* **key** ( string ) The key prefix to use as expression.
* **value** ( string ) The value.

#### Example

       SET 0 app:news:item:hits 10 // This will create a 'app:news:item:hits' item with the '10' content and no TTL.
  
       SET 0 app:news:other-item:hits 23
  
       MSET app:news 0 // Reset both
  

#### Notes

* This operator will fail for LOCKed items.
* Return the number of modified items, otherwise an error.
