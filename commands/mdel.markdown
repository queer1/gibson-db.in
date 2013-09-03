---
layout: default
title: MDEL Command Reference 
---

# MDEL

Delete keys verifying the given prefix.  

* * *

#### Syntax

        MDEL <prefix>  

#### Arguments

* **prefix** ( string ) The key prefix to use as expression.

#### Example

       SET 0 foo bar
  
       SET 0 fuu bur
  
       MDEL f
  

#### Notes

* This operator will fail for LOCKed items.
* Return the number of deleted items in case of success, otherwise an error.
