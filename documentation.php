<?php $__TITLE = 'Documentation'; include_once 'inc/header.php'; ?>

<article id="topic">

<h1>Documentation</h1>
<p>
<ul>
    <li><a href="#intro">Introduction</a></li>
    <li><a href="#configuration">Configuration</a></li>
    <li><a href="#cclient">Using the console client</a></li>
    <li><a href="/commands.php">Command Reference</a></li>
    <li><a href="/clients.php">Other Clients</a></li>
    <li><a href="/protocol.php">Protocol Specifications</a></li>
    <li><a href="/trie-data-structure.php">The Trie Data Structure</a></li>
    <li><a href="#scaling">Make Gibson scale</a>
    <li><a href="#phpsession">Gibson as a PHP session handler</a>
    <li><a href="#wp">Gibson as a Wordpress object cache backend</a>
</ul>
</p>

<hr id="intro"/>
<h4>Introduction</h4>
		<div>
			Gibson is a high efficiency, <a href="http://gibson-db.in/trie-data-structure.php">tree based</a> memory cache server.&nbsp;</div>
		<div>
			Normal key-value stores ( memcache, Redis, etc ) uses a hash table as their main data structure, so every key is hashed with a specific algorithm and the resulting hash is used to identify the given value in memory. This approach, although very fast, doesn&#39;t allow the user to execute globbing expressions/selections on a given (multiple) keyset, thus resulting on a pure one-by-one access paradigm.</div>
		<div>
			Gibson is different, it uses a special tree based structure allowing the user to perform operations on multiple key sets using a prefix expression achieving the same performance grades in the worst case, even better on an average case.</div>
		<div>
			Unlike many other server applications, it&#39;s not multithreaded, but it uses multiplexing taking advantace of an event-driven network layer ( just like Node.js, or Nginx using libevent and so on ) which provides higher performances even on low cost hardware.</div>
		<div>
			&nbsp;</div>
		<div>
			<span style="color:#008000;"><strong>You need Gibson if:</strong></span></div>
		<ul>
			<li>
				You need to cache result sets from heavy queries lowering your main database load and response times.</li>
			<li>
				You want to invalidate or rietrive multiple cached items&nbsp;hierarchically with a single command given their common prefix, in lower than linear time.</li>
			<li>
				You need a cache backend which is fast, highly scalable and not redundant as the common key value store.</li>
		</ul>
		<div>
			&nbsp;</div>
		<div>
			<span style="color:#ff0000;"><strong>You can&#39;t use Gibson to:</strong></span></div>
		<ul>
			<li>
				You can&#39;t use Gibson as a drop in replacement for your database, since it is NOT a database but a key value store.</li>
			<li>
				You need complex data structures such as lists, sets, etc to be cached as they are ( without serializing it ).</li>
			<li>
				You need to perform sorting on cached items.</li>
		</ul>

<hr id="configuration"/>
<h4>Configuration</h4>
<p>
After <a href="/download.php">compiling and installing</a> Gibson source code release, you might want to edit the configuration file situated in
<strong>/etc/gibson/gibson.conf</strong>, even if <a href="https://raw.github.com/evilsocket/gibson/master/gibson.conf">standard values</a> will fit the majority of situations.
</p>
<p>Let's see each configuration directive purpose.</p>

<h3>logfile</h3>
<p>
The log file path, or /dev/stdout to log on the terminal output.
</p>

<h3>loglevel</h3>
<p>
Integer number representing the verbosity of the log manager:<br/>
<ul>
	<li>0 for <strong>DEBUG</strong> verbosity, every message even debug ones will be logged.</li>
	<li>1 for <strong>INFO</strong> verbosity, only information messages, warning, errors and criticals will be logged.</li> 
	<li>2 for <strong>WARNING</strong> verbosity, only warnings, errors and criticals will be logged</li> 
	<li>3 for <strong>ERROR</strong> verbosity, only errors and criticals will be logged.</li>
	<li>4 for <strong>CRITICAL</strong> verbosity, only segmentation faults will be logged.</li>
</ul>
</p>

<h3>logflushrate</h3>
<p>
How often to flush logfile, where 1 stands for "flush the log file every new line".
</p>

<h3>unix_socket</h3>
<p>
The UNIX socket path to use if Gibson will run in a local environment, use the directives <strong>address</strong> and <strong>port</strong> to create
a TCP server instead.
</p>

<h3>address</h3>
<p>
Address to bind the TCP server to.
</p>

<h3>port</h3>
<p>
TCP port to use for server listening.
</p>

<h3>daemonize</h3>
<p>
If 1 the process server will be daemonized ( put on background ), otherwise will run synchronously with the caller process.
</p>

<h3>pidfile</h3>
<p>
File to be used to save the current Gibson process id.
</p>

<h3>max_memory</h3>
<p>
    Maximum memory to be used by the Gibson server, when this value is reached, the server will try to deallocate old objects to free space ( see <b>gc_ratio</b> ) and, if 
there aren't freeable objects at the moment, will refuse to accept new objects with a <strong>REPL_ERR_MEM</strong> error reply.
</p>

<h3>gc_ratio</h3>
<p>
If <b>max_memory</b> is reached, data that is not being accessed in this amount of time ( i.e. gc_ratio 1h = data that is not being accessed in the last hour ) get deleted to release memory for the server.
</p>

<h3>max_item_ttl</h3>
<p>
Maximum time-to-live an object can have.
</p>

<h3>max_idletime</h3>
<p>
Maximum time in seconds a client can be idle ( without read or write operations ), after this period the client connection will be closed.
</p>

<h3>max_clients</h3>
<p>
Maximum number of clients Gibson can hadle concurrently.
</p>

<h3>max_request_size</h3>
<p>
Maximum size of a client request.
</p>

<h3>max_key_size</h3>
<p>
Maximum size of the key for a Gibson object.
</p>

<h3>max_value_size</h3>
<p>
Maximum size of the value for a Gibson object.
</p>

<h3>max_response_size</h3>
<p>
Maximum Gibson response size, used to limit I/O when a M* operator is used.
</p>

<h3>compression</h3>
<p>
Objects above this size will be compressed in memory.
</p>

<h3>cron_period</h3>
<p>
Number of milliseconds between each cron schedule, do not put a value higher than 1000.
</p>

<hr id="cclient"/>
<h4>Using the console client</h4>
<p>
Once your Gibson instance is up and running, you might want to download and install its <a href="https://github.com/evilsocket/libgibsonclient">client library</a> which provides the default
console client too.
</p>
<p>
    <pre>$ git clone https://github.com/evilsocket/libgibsonclient.git
$ cd libgibsonclient
$ git submodule init
$ git submodule update
$ cmake .
$ make
# make install</pre>
</p>
<p>The client command line arguments are pretty straightforward:
<pre># gibson-cli -h                                                                                                                             
Gibson client utility.

gibson-cli [-h|--help] [-a|--address ADDRESS] [-p|--port PORT] [-u|--unix UNIX_SOCKET_PATH]

  -h, --help            	  Print this help and exit.
  -a, --address ADDRESS   	  TCP address of Gibson instance.
  -p, --port PORT   		  TCP port of Gibson instance.
  -u, --unix UNIX_SOCKET_PATH Unix socket path of Gibson instance ( overrides TCP arguments ).
</pre>
So if you want to connect to a TCP instance, you will type for instance:
<pre>gibson-cli --address 127.0.0.1 --port 10128</pre>
Or, to connect to a Unix socket instance:
<pre>gibson-cli --unix /var/run/gibson.sock</pre>
</p>

<p>Once you are connected, you will see a prompt like this:
<pre>type :quit or :q to quit.

127.0.0.1:10128&gt; 
</pre>
Now you can start using the client typing the command you want to execute.</p>
<p>For a complete command list ( and their syntax ), refer to the <a href="/protocol.php">protocol specs</a> and/or type the command string
to see its synax, for instance:
<pre>127.0.0.1:10128&gt; set
ERROR: Invalid parameters, correct syntax is:
	SET &lt;ttl&gt; &lt;key&gt; &lt;value&gt;
</pre>
</p>


<hr id="scaling"/>
<h4>Make Gibson Scale</h4>
<p>
Gibson is a single threaded, multiplexing server, this means that it doesn't actually serves many requests concurrently, but it's able to process
them one by one exactly when the kernel tell the client is in a readable or writable state.<br/>
This might seems a slow approach compared to multi threaded implementations but it's not, on the contrary this results in a performance optimization
in many situations, just think about the fact that modern event-driven programs ( such as Node.js ) use this kind of approach.
</p>
<p>This also means that Gibson will use only one core/cpu of your machine, even if you have many of them, so to scale Gibson you will need to run 
multiple instances of it, each one running on its own port/socket, and then from the client side choose the right server to connect to, maybe with
a simple algorithm like the following:</p>

<p>
<script type="text/javascript" src="http://www.emoticode.net/php/make-gibson-scale.js"></script>
</p>

<hr id="phpsession"/>
<h4>Gibson as a PHP session handler</h4>
<p>Gibson can be used as a <strong>fast</strong> PHP custom session handler to reduce filesystem and db workload.</p>
<p>
<script type="text/javascript" src="http://www.emoticode.net/php/custom-session-handler-with-gibson-cache-server.js"></script>
</p>

<hr id="wp"/>
<h4>As a Wordpress Object Cache backend</h4>
<p>On top of the <a href="/phpgibson.php">PHP5 extension</a>, a Wordpress object cache backend was developed, to use it in your Wordpress installation put the object-cache.php
file in the <strong>wp-content</strong> folder of your blog.</p>
<p>The wpgibson repository can be found <a href="https://github.com/evilsocket/wpgibson">here</a>.</p>

</article>
<?php include_once 'inc/disqus.php'; ?>
<?php include_once 'inc/footer.php'; ?>
