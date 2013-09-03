---
layout: default
title: INC Command Reference 
---

# INC

Increment by one the given key.  

* * *

#### Syntax

        INC <key>  

#### Arguments

* **key** ( string ) The key to increment.

#### Example

       SET 0 foo 10 // foo encoding is GB_ENC_PLAIN now
  
       INC foo // Now foo is 11 encoded as GB_ENC_NUMBER
  

#### Notes

* INC will change internal value encoding from GB_ENC_PLAIN to GB_ENC_NUMBER
* Return the new incremented value in case of success, otherwise an error.
* If the value is not a parsable number, REPL_ERR_NAN will be returned.
