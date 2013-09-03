---
layout: default
title: META Command Reference 
---

# META

Obtain a specific information about a given item.  

* * *

#### Syntax

        META <key> <field>  

#### Arguments

* **key** ( string ) The key of the value to search.
* **field** ( string ) The information name to retrieve, allowed values follow.
Valid values:  
   * **size**: The size in bytes of the item value.
   * **encoding**: The value encoding.
   * **access**: Timestamp of the last time the item was accessed.
   * **created**: Timestamp of item creation.
   * **ttl**: Item specified time to live, -1 for infinite TTL.
   * **left**: Number of seconds left for the item to live if a ttl was specified, otherwise -1.
   * **lock**: Number of seconds the item is locked, -1 if there's no lock.

#### Example

       META foo encoding // will print 'foo' encoding
  
       META foo size  // its size
  
       META foo access // last access time
  
