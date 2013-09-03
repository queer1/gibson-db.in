---
layout: default
title: STATS Command Reference 
---

# STATS

Get system stats about the Gibson instance.  

* * *

#### Syntax

        STATS  

#### Example

       STATS
  

#### Notes

* The following values will be returned:
    * **server_version** Version of the server instance.
    * **server_build_datetime** Date and time the server was built.
    * **server_allocator** Memory allocator used by the server.
    * **server_arch** Server processor architecture.
    * **server_started** Unix timestamp the server was started.
    * **server_time** Internal unix timestamp of the server.
    * **first_item_seen** Unix timestamp of the first created item.
    * **last_item_seen** Unix timestamp of the last created item.
    * **total_items** Number of total items stored by this server-
    * **total_compressed_items** Number of LZF compressed items stored by this server.
    * **total_clients** Number of currently connected clients.
    * **total_cron_done** Number of cron loops the server has performed since it was started.
    * **total_connections** Number of connections the server received.
    * **total_requests** Number of valid requests the server executed.
    * **memory_available** Total memory available.
    * **memory_usable** Server usable memory limit.
    * **memory_used** Currently used memory-
    * **memory_peak** Max used memory since the server was started.
    * **memory_fragmentation** Value of RSS / memory used.
    * **item_size_avg** Average size of an item.
    * **compr_rate_avg** Average LZF compression rate.
    * **reqs_per_client_avg** Average number of requests per client.
