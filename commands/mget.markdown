---
layout: default
title: MGET Command Reference 
---

# MGET

Get the value for a given prefix.  

* * *

#### Syntax

        MGET <prefix>  

#### Arguments

* **prefix** ( string ) The key prefix to use as expression.

#### Example

       SET 0 foo bar
  
       SET 0 fuu bur
  
       MGET f
  

#### Notes

* Return a REPL_KVAL with keys and values verifying the given expression in case of success, otherwise an error.
