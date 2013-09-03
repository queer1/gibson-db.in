---
layout: default
title: MDEC Command Reference 
---

# MDEC

Decrement by one keys verifying the given prefix.  

* * *

#### Syntax

        MDEC <prefix>  

#### Arguments

* **prefix** ( string ) The key prefix to use as expression.

#### Example

       SET 0 foo 10
  
       SET 0 fuu 1
  
       MDEC f // Now foo is 9 and fuu is 0
  

#### Notes

* MDEC will change internal value encoding from GB_ENC_PLAIN to GB_ENC_NUMBER
* Return the number of succesfully decremented values in case of success, otherwise an error.
