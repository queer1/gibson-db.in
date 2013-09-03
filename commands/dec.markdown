---
layout: default
title: DEC Command Reference 
---

# DEC

Decrement by one the given key.  

* * *

#### Syntax

        DEC <key>  

#### Arguments

* **key** ( string ) The key to decrement.

#### Example

       SET 0 foo 10 // foo encoding is GB_ENC_PLAIN now
  
       DEC foo // Now foo is 9 encoded as GB_ENC_NUMBER
  

#### Notes

* DEC will change internal value encoding from GB_ENC_PLAIN to GB_ENC_NUMBER
* Return the new decremented value in case of success, otherwise an error.
* If the value is not a parsable number, REPL_ERR_NAN will be returned.
