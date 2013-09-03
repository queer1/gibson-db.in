---
layout: default
title: COUNT Command Reference 
---

# COUNT

Count items for a given prefix.  

* * *

#### Syntax

        COUNT <prefix>  

#### Arguments

* **prefix** ( string ) The key prefix to use as expression.

#### Example

       SET 0 foo bar
  
       SET 0 fuu bur
  
       COUNT f // will return 2
  
