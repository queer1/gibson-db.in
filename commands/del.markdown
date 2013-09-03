---
layout: default
title: DEL Command Reference 
---

# DEL

Delete the given key.  

* * *

#### Syntax

        DEL <key>  

#### Arguments

* **key** ( string ) The key to delete.

#### Example

       SET 0 foo bar
  
       DEL foo
  

#### Notes

* This operator will fail for LOCKed items.
