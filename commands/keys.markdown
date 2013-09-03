---
layout: default
title: KEYS Command Reference 
---

# KEYS

Return a list of keys matching the given prefix.  

* * *

#### Syntax

        KEYS <prefix>  

#### Arguments

* **prefix** ( string ) The key prefix to use as expression.

#### Example

       SET 0 foo bar
  
       SET 0 fuu bur
  
       KEYS f // will return [foo,fuu]
  
