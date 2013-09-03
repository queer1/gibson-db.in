---
layout: default
title: SET Command Reference 
---

# SET

Set the value for the given key, with an optional TTL.  

* * *

#### Syntax

        SET <ttl> <key> <value>  

#### Arguments

* **ttl** ( int ) The optional ttl in seconds.
* **key** ( string ) The key to set.
* **value** ( string ) The value.

#### Example

       SET 0 foo bar // This will create a 'foo' item with the 'bar' content and no TTL.
  
       SET 0 foo newvalue // Overwrite the old value of 'foo'.
  
       SET 10 hello world // Create a 'hello' item that is going to expire in 10 seconds
  

#### Notes

* This operator will fail for LOCKed items.
* On success the new set value will be returned, otherwise an error.
