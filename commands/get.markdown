---
layout: default
title: GET Command Reference 
---

# GET

Get the value for a given key.  

* * *

#### Syntax

        GET <key>  

#### Arguments

* **key** ( string ) The key to get.

#### Example

       SET 0 foo bar
  
       GET foo
  

#### Notes

* Return the item value in case of success, otherwise an error.
