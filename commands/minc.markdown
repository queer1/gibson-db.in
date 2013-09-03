---
layout: default
title: MINC Command Reference 
---

# MINC

Increment by one keys verifying the given prefix.  

* * *

#### Syntax

        MINC <prefix>  

#### Arguments

* **prefix** ( string ) The key prefix to use as expression.

#### Example

       SET 0 foo 10
  
       SET 0 fuu 1
  
       MINC f // Now foo is 11 and fuu is 2
  

#### Notes

* MINC will change internal value encoding from GB_ENC_PLAIN to GB_ENC_NUMBER
* Return the number of succesfully incremented values in case of success, otherwise an error.
