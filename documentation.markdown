---
layout: default
title: Documentation
---

# Documentation

* [Introduction](#intro)
* [Compilation](/download.html)
* [Configuration](#configuration)
* [Using the console client](#cclient)
* [Command Reference](/commands.html)
* [Clients](/clients.html)
* [Protocol Specifications](/protocol.html)
* [The Trie Data Structure](/trie-data-structure.html)
* [Make Gibson scale](#scaling)
* [Gibson as a PHP session handler](#phpsession)
* [Gibson as a Wordpress object cache backend](#wp)

* * *

#### Introduction

Gibson is a high efficiency, [tree based](/trie-data-structure.html) memory cache server.  
Normal key-value stores ( memcache, Redis, etc ) uses a hash table as their main data structure, so every key is hashed with a specific algorithm and the resulting hash is used to identify the given value in memory. This approach, although very fast, doesn&#39;t allow the user to execute globbing expressions/selections on a given (multiple) keyset, thus resulting on a pure one-by-one access paradigm.  

Gibson is different, it uses a special tree based structure allowing the user to perform operations on multiple key sets using a prefix expression achieving the same performance grades in the worst case, even better on an average case.  
Unlike many other server applications, it&#39;s not multithreaded, but it uses multiplexing taking advantace of an event-driven network layer ( just like Node.js, or Nginx using libevent and so on ) which provides higher performances even on low cost hardware.

<span style="color:#008000;">**You need Gibson if:**</span>

* You need to cache result sets from heavy queries lowering your main database load and response times.
* You want to invalidate or rietrive multiple cached items&nbsp;hierarchically with a single command given their common prefix, in lower than linear time.
* You need a cache backend which is fast, highly scalable and not redundant as the common key value store.

<span style="color:#ff0000;">**You can&#39;t use Gibson to:**</span>

* You can&#39;t use Gibson as a drop in replacement for your database, since it is NOT a database but a key value store.
* You need complex data structures such as lists, sets, etc to be cached as they are ( without serializing it ).
* You need to perform sorting on cached items.

* * *

#### Configuration

After [compiling and installing](/download.html) Gibson source code release, you might want to edit the configuration file situated in
**/etc/gibson/gibson.conf**, even if [standard values](https://raw.github.com/evilsocket/gibson/master/gibson.conf) will fit the majority of situations.

Let's see each configuration directive purpose.

### logfile

The log file path, or /dev/stdout to log on the terminal output.

### loglevel

Integer number representing the verbosity of the log manager:

* 0 for **DEBUG** verbosity, every message even debug ones will be logged.
* 1 for **INFO** verbosity, only information messages, warning, errors and criticals will be logged.
* 2 for **WARNING** verbosity, only warnings, errors and criticals will be logged
* 3 for **ERROR** verbosity, only errors and criticals will be logged.
* 4 for **CRITICAL** verbosity, only segmentation faults will be logged.

### logflushrate

How often to flush logfile, where 1 stands for "flush the log file every new line".

### unix_socket

The UNIX socket path to use if Gibson will run in a local environment, use the directives **address** and **port** to create
a TCP server instead.

### address

Address to bind the TCP server to.

### port

TCP port to use for server listening.

### daemonize

If 1 the process server will be daemonized ( put on background ), otherwise will run synchronously with the caller process.

### pidfile

File to be used to save the current Gibson process id.

### max_memory

Maximum memory to be used by the Gibson server, when this value is reached, the server will try to deallocate old objects to free space ( see **gc_ratio** ) and, if 
there aren't freeable objects at the moment, will refuse to accept new objects with a **REPL_ERR_MEM** error reply.

### gc_ratio

If **max_memory** is reached, data that is not being accessed in this amount of time ( i.e. gc_ratio 1h = data that is not being accessed in the last hour ) get deleted to release memory for the server.

### max_item_ttl

Maximum time-to-live an object can have.

### max_idletime

Maximum time in seconds a client can be idle ( without read or write operations ), after this period the client connection will be closed.

### max_clients

Maximum number of clients Gibson can hadle concurrently.

### max_request_size

Maximum size of a client request.

### max_key_size

Maximum size of the key for a Gibson object.

### max_value_size

Maximum size of the value for a Gibson object.

### max_response_size

Maximum Gibson response size, used to limit I/O when a M* operator is used.

### compression

Objects above this size will be compressed in memory.

### cron_period

Number of milliseconds between each cron schedule, do not put a value higher than 1000.

### max_mem_cron

Check if max memory usage is reached every 'max_mem_cron' seconds.

### expired_cron

Check for expired items every 'expired_cron' seconds.

* * *

#### Using the console client

Once your Gibson instance is up and running, you might want to download and install its [client library](https://github.com/evilsocket/libgibsonclient) which provides the default
console client too.

    $ git clone https://github.com/evilsocket/libgibsonclient.git
    $ cd libgibsonclient
    $ git submodule init
    $ git submodule update
    $ cmake .
    $ make
    # make install

The client command line arguments are pretty straightforward:

    # gibson-cli -h                                                                                                                             
    Gibson client utility.

    gibson-cli [-h|--help] [-a|--address ADDRESS] [-p|--port PORT] [-u|--unix UNIX_SOCKET_PATH]

    -h, --help                Print this help and exit.
    -a, --address ADDRESS       TCP address of Gibson instance.
    -p, --port PORT         TCP port of Gibson instance.
    -u, --unix UNIX_SOCKET_PATH Unix socket path of Gibson instance ( overrides TCP arguments ).

So if you want to connect to a TCP instance, you will type for instance:

    gibson-cli --address 127.0.0.1 --port 10128

Or, to connect to a Unix socket instance:

    gibson-cli --unix /var/run/gibson.sock

Once you are connected, you will see a prompt like this:

    type :quit or :q to quit.

    127.0.0.1:10128&gt; 

Now you can start using the client typing the command you want to execute.

For a complete command list ( and their syntax ), refer to the [protocol specs](/protocol.html) and/or type the command string
to see its synax, for instance:

  127.0.0.1:10128&gt; set
  ERROR: Invalid parameters, correct syntax is:
  SET &lt;ttl&gt; &lt;key&gt; &lt;value&gt;

* * *

#### Make Gibson Scale

Gibson is a single threaded, multiplexing server, this means that it doesn't actually serves many requests concurrently, but it's able to process
them one by one exactly when the kernel tell the client is in a readable or writable state.

This might seems a slow approach compared to multi threaded implementations but it's not, on the contrary this results in a performance optimization
in many situations, just think about the fact that modern event-driven programs ( such as Node.js ) use this kind of approach.

This also means that Gibson will use only one core/cpu of your machine, even if you have many of them, so to scale Gibson you will need to run 
multiple instances of it, each one running on its own port/socket, and then from the client side choose the right server to connect to, maybe with
a simple algorithm like the following:

<script type="text/javascript" src="http://www.emoticode.net/php/make-gibson-scale.js"></script>

* * *

#### Gibson as a PHP session handler

Gibson can be used as a **fast** PHP custom session handler to reduce filesystem and db workload.

<script type="text/javascript" src="http://www.emoticode.net/php/custom-session-handler-with-gibson-cache-server.js"></script>

* * *

#### As a Wordpress Object Cache backend

On top of the [PHP5 extension](/phpgibson.html), a Wordpress object cache backend was developed, to use it in your Wordpress installation put the object-cache.html
file in the **wp-content** folder of your blog.

The wpgibson repository can be found [here](https://github.com/evilsocket/wpgibson).