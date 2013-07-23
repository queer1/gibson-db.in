<?php $__TITLE = 'Using the PHP5 Client Extension'; include_once 'inc/header.php'; ?>

<article>
<ul class="breadcrumb">
    <li><a href="/documentation.php">Documentation</a> <span class="divider">/</span></li>
    <li><a href="/clients.php">Clients</a> <span class="divider">/</span></li>
    <li class="active">phpgibson</li>
</ul>
<h1><a name="phpgibson" class="anchor" href="#phpgibson"><span class="octicon octicon-link"></span></a>Using the PHP5 Client Extension</h1>

<p>The <strong>phpgibson</strong> extension provides an API for communicating with the Gibson cache server. It is released under the BSD License.</p>

<p>You can send comments, patches, questions <a href="https://github.com/evilsocket/phpgibson/issues">on github</a> or to <a href="http://twitter.com/evilsocket">@evilsocket</a>.</p>

<h1>
<a name="table-of-contents" class="anchor" href="#table-of-contents"><span class="octicon octicon-link"></span></a>Table of contents</h1>

<hr><ol>
<li>
<a href="#installingconfiguring">Installing/Configuring</a>

<ul>
<li><a href="#installation">Installation</a></li>
<li><a href="#installation-on-osx">Installation on OSX</a></li>
<li><a href="#building-on-windows">Building on Windows</a></li>
</ul>
</li>
<li>
<a href="#classes-and-methods">Classes and methods</a>

<ul>
<li><a href="#usage">Usage</a></li>
<li><a href="#connection">Connection</a></li>
<li><a href="#methods">Methods</a></li>
</ul>
</li>
</ol><hr><h1>
<a name="installingconfiguring" class="anchor" href="#installingconfiguring"><span class="octicon octicon-link"></span></a>Installing/Configuring</h1>

<hr><p>Everything you should need to install PhpGibson on your system.</p>

<h2>
<a name="installation" class="anchor" href="#installation"><span class="octicon octicon-link"></span></a>Installation</h2>

<pre><code>phpize
./configure
make &amp;&amp; make install
</code></pre>

<p>This extension exports a single class, <a href="#class-gibson">Gibson</a>.</p>

<h2>
<a name="installation-on-osx" class="anchor" href="#installation-on-osx"><span class="octicon octicon-link"></span></a>Installation on OSX</h2>

<p>If the install fails on OSX, type the following commands in your shell before trying again:</p>

<pre><code>MACOSX_DEPLOYMENT_TARGET=10.6
CFLAGS="-arch i386 -arch x86_64 -g -Os -pipe -no-cpp-precomp"
CCFLAGS="-arch i386 -arch x86_64 -g -Os -pipe"
CXXFLAGS="-arch i386 -arch x86_64 -g -Os -pipe"
LDFLAGS="-arch i386 -arch x86_64 -bind_at_load"
export CFLAGS CXXFLAGS LDFLAGS CCFLAGS MACOSX_DEPLOYMENT_TARGET
</code></pre>

<p>If that still fails and you are running Zend Server CE, try this right before "make": <code>./configure CFLAGS="-arch i386"</code>.</p>

<h2>
<a name="building-on-windows" class="anchor" href="#building-on-windows"><span class="octicon octicon-link"></span></a>Building on Windows</h2>

<ol>
<li>Install visual studio 2008 (express or professional). If using visual studio 2008 express, also install the latest windows SDK.</li>
<li>Download PHP source code</li>
<li>Extract to C:\php\php-5.4.9</li>
<li>Download <a href="http://windows.php.net/downloads/php-sdk/php-sdk-binary-tools-20110915.zip">http://windows.php.net/downloads/php-sdk/php-sdk-binary-tools-20110915.zip</a> and extract to C:\php</li>
<li>In cmd.exe

<ul>
<li>cd C:\php\php-5.4.9\ext</li>
<li>git clone <a href="https://github.com/evilsocket/phpgibson.git">https://github.com/evilsocket/phpgibson.git</a>
</li>
<li>cd ..</li>
<li>buildconf.js</li>
<li>"C:\Program Files\Microsoft SDKs\Windows\v7.1\Bin\SetEnv" /x86 /xp /release</li>
<li>path "C:\Program Files\Microsoft SDKs\Windows\v7.1\Bin";%PATH%</li>
<li>bin\phpsdk_setvars.bat</li>
<li>"C:\Program Files\Microsoft Visual Studio 9.0\VC\vcvarsall.bat"</li>
<li>configure.js --disable-all --enable-cli --enable-gibson </li>
<li>nmake php_gibson.dll</li>
<li>fix any compilation errors</li>
</ul>
</li>
</ol><h1>
<a name="classes-and-methods" class="anchor" href="#classes-and-methods"><span class="octicon octicon-link"></span></a>Classes and methods</h1>

<hr><h2>
<a name="usage" class="anchor" href="#usage"><span class="octicon octicon-link"></span></a>Usage</h2>

<ol>
<li><a href="#class-gibson">Class Gibson</a></li>
</ol><h3>
<a name="class-gibson" class="anchor" href="#class-gibson"><span class="octicon octicon-link"></span></a>Class Gibson</h3>

<hr><p><em><strong>Description</strong></em>: Creates a Gibson client</p>

<h5>
<a name="example" class="anchor" href="#example"><span class="octicon octicon-link"></span></a><em>Example</em>
</h5>

<pre><code>$gb = new Gibson();
</code></pre>

<h2>
<a name="connection" class="anchor" href="#connection"><span class="octicon octicon-link"></span></a>Connection</h2>

<ol>
<li>
<a href="#connect">connect</a> - Connect to a server</li>
<li>
<a href="#pconnect">pconnect</a> - Create a persistent connection or reuse a previous one if present.</li>
<li>
<a href="#quit">quit</a> - Close the connection</li>
</ol><h3>
<a name="connect" class="anchor" href="#connect"><span class="octicon octicon-link"></span></a>connect</h3>

<hr><p><em><strong>Description</strong></em>: Connects to a Gibson instance.</p>

<h5>
<a name="parameters" class="anchor" href="#parameters"><span class="octicon octicon-link"></span></a><em>Parameters</em>
</h5>

<p><em>host</em>: string. can be a host, or the path to a unix domain socket<br><em>port</em>: int, optional<br><em>timeout</em>: float, value in milli seconds (optional, default is 0 meaning unlimited)  </p>

<h5>
<a name="return-value" class="anchor" href="#return-value"><span class="octicon octicon-link"></span></a><em>Return value</em>
</h5>

<p><em>BOOL</em>: <code>TRUE</code> on success, <code>FALSE</code> on error.</p>

<h5>
<a name="example-1" class="anchor" href="#example-1"><span class="octicon octicon-link"></span></a><em>Example</em>
</h5>

<pre><code>$gibson-&gt;connect('127.0.0.1', 10128);
$gibson-&gt;connect('127.0.0.1'); // port 10128 by default
$gibson-&gt;connect('127.0.0.1', 10128, 200); // 200 ms timeout.
$gibson-&gt;connect('/tmp/gibson.sock'); // unix domain socket.
</code></pre>

<h3>
<a name="pconnect" class="anchor" href="#pconnect"><span class="octicon octicon-link"></span></a>pconnect</h3>

<hr><p><em><strong>Description</strong></em>: Create a persistent connection or reuse a previous one if present. If a previous connection exists but
is not valid ( timed out, disconnected, etc ) the connection will be enstablished again.</p>

<h5>
<a name="parameters-1" class="anchor" href="#parameters-1"><span class="octicon octicon-link"></span></a><em>Parameters</em>
</h5>

<p><em>host</em>: string. can be a host, or the path to a unix domain socket<br><em>port</em>: int, optional<br><em>timeout</em>: float, value in milli seconds (optional, default is 0 meaning unlimited)  </p>

<h5>
<a name="return-value-1" class="anchor" href="#return-value-1"><span class="octicon octicon-link"></span></a><em>Return value</em>
</h5>

<p><em>BOOL</em>: <code>TRUE</code> on success, <code>FALSE</code> on error.</p>

<h5>
<a name="example-2" class="anchor" href="#example-2"><span class="octicon octicon-link"></span></a><em>Example</em>
</h5>

<pre><code>$gibson-&gt;pconnect('127.0.0.1', 10128);
$gibson-&gt;pconnect('127.0.0.1'); // port 10128 by default
$gibson-&gt;pconnect('127.0.0.1', 10128, 200); // 200 ms timeout.
$gibson-&gt;pconnect('/tmp/gibson.sock'); // unix domain socket.
</code></pre>

<h3>
<a name="quit" class="anchor" href="#quit"><span class="octicon octicon-link"></span></a>quit</h3>

<hr><p><em><strong>Description</strong></em>: Disconnects from the Gibson instance.</p>

<h2>
<a name="methods" class="anchor" href="#methods"><span class="octicon octicon-link"></span></a>Methods</h2>

<ol>
<li>
<a href="#getLastError">getLastError</a> - If an error occurred, return its human readable description.</li>
<li>
<a href="#set">set</a> - Set the value for the given key, with an optional TTL.</li>
<li>
<a href="#mset">mset</a> - Set the value for keys verifying the given expression.</li>
<li>
<a href="#ttl">ttl</a> - Set the TTL of a key.</li>
<li>
<a href="#mttl">mttl</a> - Set the TTL for keys verifying the given expression.</li>
<li>
<a href="#get">get</a> - Get the value for a given key.</li>
<li>
<a href="#mget">mget</a> - Get the values for keys verifying the given expression.</li>
<li>
<a href="#del">del</a> - Delete the given key.</li>
<li>
<a href="#mdel">mdel</a> - Delete keys verifying the given expression.</li>
<li>
<a href="#inc">inc</a> - Increment by one the given key.</li>
<li>
<a href="#minc">minc</a> - Increment by one keys verifying the given expression.</li>
<li>
<a href="#mdec">mdec</a> - Decrement by one the given keys.</li>
<li>
<a href="#dec">dec</a> - Decrement by one keys verifying the given expression.</li>
<li>
<a href="#lock">lock</a> - Prevent the given key from being modified for a given amount of seconds.</li>
<li>
<a href="#mlock">mlock</a> - Prevent keys verifying the given expression from being modified for a given amount of seconds.</li>
<li>
<a href="#unlock">unlock</a> - Remove the lock on a given key.</li>
<li>
<a href="#munlock">munlock</a> - Remove the lock on keys verifying the given expression.</li>
<li>
<a href="#count">count</a> - Count items for a given expression.</li>
<li>
<a href="#meta">meta</a> - Obtain a specific information about a given item.</li>
<li>
<a href="#stats">stats</a> - Get system stats about the Gibson instance.</li>
<li>
<a href="#keys">keys</a> - Return a list of keys matching the given prefix.</li>
<li>
<a href="#ping">ping</a> - Ping the server instance to refresh client last seen timestamp.</li>
</ol><h3>
<a name="getlasterror" class="anchor" href="#getlasterror"><span class="octicon octicon-link"></span></a>getLastError</h3>

<hr><p><em><strong>Description</strong></em>: If an error occurred, return its human readable description.</p>

<h5>
<a name="parameters-2" class="anchor" href="#parameters-2"><span class="octicon octicon-link"></span></a><em>Parameters</em>
</h5>

<p>None.</p>

<h5>
<a name="return-value-2" class="anchor" href="#return-value-2"><span class="octicon octicon-link"></span></a><em>Return value</em>
</h5>

<p><em>string</em>: The error description.</p>

<h5>
<a name="example-3" class="anchor" href="#example-3"><span class="octicon octicon-link"></span></a><em>Example</em>
</h5>

<pre><code>echo $gibson-&gt;getLastError();
</code></pre>

<h3>
<a name="set" class="anchor" href="#set"><span class="octicon octicon-link"></span></a>set</h3>

<hr><p><em><strong>Description</strong></em>: Set the value for the given key, with an optional TTL.</p>

<h5>
<a name="parameters-3" class="anchor" href="#parameters-3"><span class="octicon octicon-link"></span></a><em>Parameters</em>
</h5>

<p><em>key</em> (string) The key to set.
<em>value</em> (string) The value.
<em>ttl</em> (int) The optional ttl in seconds.</p>

<h5>
<a name="return-value-3" class="anchor" href="#return-value-3"><span class="octicon octicon-link"></span></a><em>Return value</em>
</h5>

<p><em>Mixed</em> The string value itself in case of success, <code>FALSE</code> in case of failure.</p>

<h5>
<a name="example-4" class="anchor" href="#example-4"><span class="octicon octicon-link"></span></a><em>Example</em>
</h5>

<pre><code>$gibson-&gt;set( 'foo', 'bar' );
$gibson-&gt;set( 'foo2', 'bar2', 2 ); // 2 seconds TTL
</code></pre>

<h3>
<a name="mset" class="anchor" href="#mset"><span class="octicon octicon-link"></span></a>mset</h3>

<hr><p><em><strong>Description</strong></em>: Set the value for keys verifying the given expression.</p>

<h5>
<a name="parameters-4" class="anchor" href="#parameters-4"><span class="octicon octicon-link"></span></a><em>Parameters</em>
</h5>

<p><em>key</em> (string) The key prefix to use as expression.
<em>value</em> (string) The value.</p>

<h5>
<a name="return-value-4" class="anchor" href="#return-value-4"><span class="octicon octicon-link"></span></a><em>Return value</em>
</h5>

<p><em>Mixed</em> The integer number of updated items in case of success, <code>FALSE</code> in case of failure.</p>

<h5>
<a name="example-5" class="anchor" href="#example-5"><span class="octicon octicon-link"></span></a><em>Example</em>
</h5>

<pre><code>$gibson-&gt;set( 'foo', 'bar' );
$gibson-&gt;set( 'fuu', 'rar' );

$gibson-&gt;mset( 'f', 'yeah' );
</code></pre>

<h3>
<a name="ttl" class="anchor" href="#ttl"><span class="octicon octicon-link"></span></a>ttl</h3>

<hr><p><em><strong>Description</strong></em>: Set the TTL of a key.</p>

<h5>
<a name="parameters-5" class="anchor" href="#parameters-5"><span class="octicon octicon-link"></span></a><em>Parameters</em>
</h5>

<p><em>key</em> (string) The key.
<em>ttl</em> (integer) The TTL in seconds.</p>

<h5>
<a name="return-value-5" class="anchor" href="#return-value-5"><span class="octicon octicon-link"></span></a><em>Return value</em>
</h5>

<p><em>BOOL</em> <code>TRUE</code> in case of success, <code>FALSE</code> in case of failure.</p>

<h5>
<a name="example-6" class="anchor" href="#example-6"><span class="octicon octicon-link"></span></a><em>Example</em>
</h5>

<pre><code>$gibson-&gt;ttl( 'foo', 3600 ); // 1 hour TTL
</code></pre>

<h3>
<a name="mttl" class="anchor" href="#mttl"><span class="octicon octicon-link"></span></a>mttl</h3>

<hr><p><em><strong>Description</strong></em>: Set the TTL for keys verifying the given expression.</p>

<h5>
<a name="parameters-6" class="anchor" href="#parameters-6"><span class="octicon octicon-link"></span></a><em>Parameters</em>
</h5>

<p><em>key</em> (string) The key prefix to use as expression.
<em>ttl</em> (integer) The TTL in seconds.</p>

<h5>
<a name="return-value-6" class="anchor" href="#return-value-6"><span class="octicon octicon-link"></span></a><em>Return value</em>
</h5>

<p><em>Mixed</em> The integer number of updated items in case of success, <code>FALSE</code> in case of failure.</p>

<h5>
<a name="example-7" class="anchor" href="#example-7"><span class="octicon octicon-link"></span></a><em>Example</em>
</h5>

<pre><code>$gibson-&gt;mttl( 'f', 3600 ); // 1 hour TTL for every f* key.
</code></pre>

<h3>
<a name="get" class="anchor" href="#get"><span class="octicon octicon-link"></span></a>get</h3>

<hr><p><em><strong>Description</strong></em>: Get the value for a given key.</p>

<h5>
<a name="parameters-7" class="anchor" href="#parameters-7"><span class="octicon octicon-link"></span></a><em>Parameters</em>
</h5>

<p><em>key</em> (string) The key to get.</p>

<h5>
<a name="return-value-7" class="anchor" href="#return-value-7"><span class="octicon octicon-link"></span></a><em>Return value</em>
</h5>

<p><em>Mixed</em> An integer or string value (depends on item encoding) in case of success, <code>FALSE</code> in case of failure.</p>

<h5>
<a name="example-8" class="anchor" href="#example-8"><span class="octicon octicon-link"></span></a><em>Example</em>
</h5>

<pre><code>$gibson-&gt;set( 'foo', 'bar' );
$gibson-&gt;get( 'foo' ); 
</code></pre>

<h3>
<a name="mget" class="anchor" href="#mget"><span class="octicon octicon-link"></span></a>mget</h3>

<hr><p><em><strong>Description</strong></em>: Get the value for a given key.</p>

<h5>
<a name="parameters-8" class="anchor" href="#parameters-8"><span class="octicon octicon-link"></span></a><em>Parameters</em>
</h5>

<p><em>key</em> (string) The key prefix to use as expression.</p>

<h5>
<a name="return-value-8" class="anchor" href="#return-value-8"><span class="octicon octicon-link"></span></a><em>Return value</em>
</h5>

<p><em>Mixed</em> An array of key =&gt; value items in case of success, <code>FALSE</code> in case of failure.</p>

<h5>
<a name="example-9" class="anchor" href="#example-9"><span class="octicon octicon-link"></span></a><em>Example</em>
</h5>

<pre><code>$gibson-&gt;mget( 'f' ); 
</code></pre>

<h3>
<a name="del" class="anchor" href="#del"><span class="octicon octicon-link"></span></a>del</h3>

<hr><p><em><strong>Description</strong></em>: Delete the given key.</p>

<h5>
<a name="parameters-9" class="anchor" href="#parameters-9"><span class="octicon octicon-link"></span></a><em>Parameters</em>
</h5>

<p><em>key</em> (string) The key to delete.</p>

<h5>
<a name="return-value-9" class="anchor" href="#return-value-9"><span class="octicon octicon-link"></span></a><em>Return value</em>
</h5>

<p><em>BOOL</em> <code>TRUE</code> in case of success, <code>FALSE</code> in case of failure.</p>

<h5>
<a name="example-10" class="anchor" href="#example-10"><span class="octicon octicon-link"></span></a><em>Example</em>
</h5>

<pre><code>$gibson-&gt;set( 'foo', 'bar' );
$gibson-&gt;del( 'foo' ); 
</code></pre>

<h3>
<a name="mdel" class="anchor" href="#mdel"><span class="octicon octicon-link"></span></a>mdel</h3>

<hr><p><em><strong>Description</strong></em>: Delete keys verifying the given expression.</p>

<h5>
<a name="parameters-10" class="anchor" href="#parameters-10"><span class="octicon octicon-link"></span></a><em>Parameters</em>
</h5>

<p><em>key</em> (string) The key prefix to use as expression.</p>

<h5>
<a name="return-value-10" class="anchor" href="#return-value-10"><span class="octicon octicon-link"></span></a><em>Return value</em>
</h5>

<p><em>Mixed</em> The integer number of deleted items in case of success, <code>FALSE</code> in case of failure.</p>

<h5>
<a name="example-11" class="anchor" href="#example-11"><span class="octicon octicon-link"></span></a><em>Example</em>
</h5>

<pre><code>$gibson-&gt;mdel( 'f' ); // Delete every f* key.
</code></pre>

<h3>
<a name="inc" class="anchor" href="#inc"><span class="octicon octicon-link"></span></a>inc</h3>

<hr><p><em><strong>Description</strong></em>: Increment by one the given key.</p>

<h5>
<a name="parameters-11" class="anchor" href="#parameters-11"><span class="octicon octicon-link"></span></a><em>Parameters</em>
</h5>

<p><em>key</em> (string) The key to increment.</p>

<h5>
<a name="return-value-11" class="anchor" href="#return-value-11"><span class="octicon octicon-link"></span></a><em>Return value</em>
</h5>

<p><em>Mixed</em> The incremented integer value in case of success, <code>FALSE</code> in case of failure.</p>

<h5>
<a name="example-12" class="anchor" href="#example-12"><span class="octicon octicon-link"></span></a><em>Example</em>
</h5>

<pre><code>$gibson-&gt;set( 'foo', '1' );
$gibson-&gt;inc( 'foo' ); 
</code></pre>

<h3>
<a name="minc" class="anchor" href="#minc"><span class="octicon octicon-link"></span></a>minc</h3>

<hr><p><em><strong>Description</strong></em>: Increment by one keys verifying the given expression.</p>

<h5>
<a name="parameters-12" class="anchor" href="#parameters-12"><span class="octicon octicon-link"></span></a><em>Parameters</em>
</h5>

<p><em>key</em> (string) The key prefix to use as expression.</p>

<h5>
<a name="return-value-12" class="anchor" href="#return-value-12"><span class="octicon octicon-link"></span></a><em>Return value</em>
</h5>

<p><em>Mixed</em> The integer number of incremented items in case of success, <code>FALSE</code> in case of failure.</p>

<h5>
<a name="example-13" class="anchor" href="#example-13"><span class="octicon octicon-link"></span></a><em>Example</em>
</h5>

<pre><code>$gibson-&gt;minc( 'f' ); // Increment by one every f* key.
</code></pre>

<h3>
<a name="dec" class="anchor" href="#dec"><span class="octicon octicon-link"></span></a>dec</h3>

<hr><p><em><strong>Description</strong></em>: Decrement by one the given key.</p>

<h5>
<a name="parameters-13" class="anchor" href="#parameters-13"><span class="octicon octicon-link"></span></a><em>Parameters</em>
</h5>

<p><em>key</em> (string) The key to decrement.</p>

<h5>
<a name="return-value-13" class="anchor" href="#return-value-13"><span class="octicon octicon-link"></span></a><em>Return value</em>
</h5>

<p><em>Mixed</em> The decremented integer value in case of success, <code>FALSE</code> in case of failure.</p>

<h5>
<a name="example-14" class="anchor" href="#example-14"><span class="octicon octicon-link"></span></a><em>Example</em>
</h5>

<pre><code>$gibson-&gt;set( 'foo', '1' );
$gibson-&gt;dec( 'foo' ); 
</code></pre>

<h3>
<a name="mdec" class="anchor" href="#mdec"><span class="octicon octicon-link"></span></a>mdec</h3>

<hr><p><em><strong>Description</strong></em>: Decrement by one keys verifying the given expression.</p>

<h5>
<a name="parameters-14" class="anchor" href="#parameters-14"><span class="octicon octicon-link"></span></a><em>Parameters</em>
</h5>

<p><em>key</em> (string) The key prefix to use as expression.</p>

<h5>
<a name="return-value-14" class="anchor" href="#return-value-14"><span class="octicon octicon-link"></span></a><em>Return value</em>
</h5>

<p><em>Mixed</em> The integer number of decremented items in case of success, <code>FALSE</code> in case of failure.</p>

<h5>
<a name="example-15" class="anchor" href="#example-15"><span class="octicon octicon-link"></span></a><em>Example</em>
</h5>

<pre><code>$gibson-&gt;mdec( 'f' ); // Decrement by one every f* key.
</code></pre>

<h3>
<a name="lock" class="anchor" href="#lock"><span class="octicon octicon-link"></span></a>lock</h3>

<hr><p><em><strong>Description</strong></em>: Prevent the given key from being modified for a given amount of seconds.</p>

<h5>
<a name="parameters-15" class="anchor" href="#parameters-15"><span class="octicon octicon-link"></span></a><em>Parameters</em>
</h5>

<p><em>key</em> (string) The key.
<em>time</em> (integer) The time in seconds to lock the item.</p>

<h5>
<a name="return-value-15" class="anchor" href="#return-value-15"><span class="octicon octicon-link"></span></a><em>Return value</em>
</h5>

<p><em>BOOL</em> <code>TRUE</code> in case of success, <code>FALSE</code> in case of failure.</p>

<h5>
<a name="example-16" class="anchor" href="#example-16"><span class="octicon octicon-link"></span></a><em>Example</em>
</h5>

<pre><code>$gibson-&gt;lock( 'foo', 3600 ); // 1 hour lock
</code></pre>

<h3>
<a name="mlock" class="anchor" href="#mlock"><span class="octicon octicon-link"></span></a>mlock</h3>

<hr><p><em><strong>Description</strong></em>: Prevent keys verifying the given expression from being modified for a given amount of seconds.</p>

<h5>
<a name="parameters-16" class="anchor" href="#parameters-16"><span class="octicon octicon-link"></span></a><em>Parameters</em>
</h5>

<p><em>key</em> (string) The key prefix to use as expression.
<em>ttl</em> (integer) The lock period in seconds.</p>

<h5>
<a name="return-value-16" class="anchor" href="#return-value-16"><span class="octicon octicon-link"></span></a><em>Return value</em>
</h5>

<p><em>Mixed</em> The integer number of locked items in case of success, <code>FALSE</code> in case of failure.</p>

<h5>
<a name="example-17" class="anchor" href="#example-17"><span class="octicon octicon-link"></span></a><em>Example</em>
</h5>

<pre><code>$gibson-&gt;mlock( 'f', 3600 ); // 1 hour lock for every f* key.
</code></pre>

<h3>
<a name="unlock" class="anchor" href="#unlock"><span class="octicon octicon-link"></span></a>unlock</h3>

<hr><p><em><strong>Description</strong></em>: Remove the lock from the given key.</p>

<h5>
<a name="parameters-17" class="anchor" href="#parameters-17"><span class="octicon octicon-link"></span></a><em>Parameters</em>
</h5>

<p><em>key</em> (string) The key.</p>

<h5>
<a name="return-value-17" class="anchor" href="#return-value-17"><span class="octicon octicon-link"></span></a><em>Return value</em>
</h5>

<p><em>BOOL</em> <code>TRUE</code> in case of success, <code>FALSE</code> in case of failure.</p>

<h5>
<a name="example-18" class="anchor" href="#example-18"><span class="octicon octicon-link"></span></a><em>Example</em>
</h5>

<pre><code>$gibson-&gt;unlock( 'foo' ); // foo now is unlocked
</code></pre>

<h3>
<a name="munlock" class="anchor" href="#munlock"><span class="octicon octicon-link"></span></a>munlock</h3>

<hr><p><em><strong>Description</strong></em>: Remove the lock on keys verifying the given expression.</p>

<h5>
<a name="parameters-18" class="anchor" href="#parameters-18"><span class="octicon octicon-link"></span></a><em>Parameters</em>
</h5>

<p><em>key</em> (string) The key prefix to use as expression.</p>

<h5>
<a name="return-value-18" class="anchor" href="#return-value-18"><span class="octicon octicon-link"></span></a><em>Return value</em>
</h5>

<p><em>Mixed</em> The integer number of unlocked items in case of success, <code>FALSE</code> in case of failure.</p>

<h5>
<a name="example-19" class="anchor" href="#example-19"><span class="octicon octicon-link"></span></a><em>Example</em>
</h5>

<pre><code>$gibson-&gt;munlock( 'f' ); // Every f* key is now unlocked.
</code></pre>

<h3>
<a name="count" class="anchor" href="#count"><span class="octicon octicon-link"></span></a>count</h3>

<hr><p><em><strong>Description</strong></em>: Count items for a given expression.</p>

<h5>
<a name="parameters-19" class="anchor" href="#parameters-19"><span class="octicon octicon-link"></span></a><em>Parameters</em>
</h5>

<p><em>key</em> (string) The key prefix to use as expression.</p>

<h5>
<a name="return-value-19" class="anchor" href="#return-value-19"><span class="octicon octicon-link"></span></a><em>Return value</em>
</h5>

<p><em>Mixed</em> The integer count of items in case of success, <code>FALSE</code> in case of failure.</p>

<h5>
<a name="example-20" class="anchor" href="#example-20"><span class="octicon octicon-link"></span></a><em>Example</em>
</h5>

<pre><code>$gibson-&gt;count( 'f' ); // Count every f* key
</code></pre>

<h3>
<a name="meta" class="anchor" href="#meta"><span class="octicon octicon-link"></span></a>meta</h3>

<hr><p><em><strong>Description</strong></em>: Obtain a specific information about a given item.</p>

<h5>
<a name="parameters-20" class="anchor" href="#parameters-20"><span class="octicon octicon-link"></span></a><em>Parameters</em>
</h5>

<p><em>key</em> (string) The key of the value to search.
<em>field</em> (string) The information name to retrieve, allowed values follow.</p>

<ul>
<li>
<em>size</em> The size in bytes of the item value.</li>
<li>
<em>encoding</em> The value encoding.</li>
<li>
<em>access</em> Timestamp of the last time the item was accessed.</li>
<li>
<em>created</em> Timestamp of item creation.</li>
<li>
<em>ttl</em> Item specified time to live, -1 for infinite ttl.</li>
<li>
<em>left</em> Number of seconds left for the item to live if a ttl was specified, otherwise -1.</li>
<li>
<em>lock</em> Number of seconds the item is locked, -1 if there's no lock.</li>
</ul><h5>
<a name="return-value-20" class="anchor" href="#return-value-20"><span class="octicon octicon-link"></span></a><em>Return value</em>
</h5>

<p><em>Mixed</em> An integer with the value in case of success, <code>FALSE</code> in case of failure.</p>

<h5>
<a name="example-21" class="anchor" href="#example-21"><span class="octicon octicon-link"></span></a><em>Example</em>
</h5>

<pre><code>$gibson-&gt;set( 'foo', 'bar' );

echo $gibson-&gt;meta( 'foo', 'created' )."\n"; // will print the actual timestamp
</code></pre>

<h3>
<a name="stats" class="anchor" href="#stats"><span class="octicon octicon-link"></span></a>stats</h3>

<hr><p><em><strong>Description</strong></em>: Get system stats about the Gibson instance.</p>

<h5>
<a name="parameters-21" class="anchor" href="#parameters-21"><span class="octicon octicon-link"></span></a><em>Parameters</em>
</h5>

<p>None</p>

<h5>
<a name="return-value-21" class="anchor" href="#return-value-21"><span class="octicon octicon-link"></span></a><em>Return value</em>
</h5>

<p><em>Mixed</em> An array of key =&gt; value items in case of success, <code>FALSE</code> in case of failure.</p>

<h5>
<a name="example-22" class="anchor" href="#example-22"><span class="octicon octicon-link"></span></a><em>Example</em>
</h5>

<pre><code>print_r( $gibson-&gt;stats() );
</code></pre>

<p>Output:</p>

<pre><code>Array
(
    [server_started] =&gt; 1369857026
    [server_time] =&gt; 1369857149
    [first_item_seen] =&gt; 1369857132
    [last_item_seen] =&gt; 1369857132
    [total_items] =&gt; 1
    [total_compressed_items] =&gt; 0
    [total_clients] =&gt; 1
    [total_cron_done] =&gt; 1228
    [memory_used] =&gt; 1772
    [memory_peak] =&gt; 1772
    [item_size_avg] =&gt; 1772
)
</code></pre>

<h3>
<a name="keys" class="anchor" href="#keys"><span class="octicon octicon-link"></span></a>keys</h3>

<hr><p><em><strong>Description</strong></em>: Return a list of keys matching the given prefix.</p>

<h5>
<a name="parameters-22" class="anchor" href="#parameters-22"><span class="octicon octicon-link"></span></a><em>Parameters</em>
</h5>

<p><em>prefix</em> (string) The key prefix to use as expression.</p>

<h5>
<a name="return-value-22" class="anchor" href="#return-value-22"><span class="octicon octicon-link"></span></a><em>Return value</em>
</h5>

<p><em>Mixed</em> The list of matching keys, <code>FALSE</code> in case of failure.</p>

<h5>
<a name="example-23" class="anchor" href="#example-23"><span class="octicon octicon-link"></span></a><em>Example</em>
</h5>

<pre><code>$gibson-&gt;set( 'app:count:a', 1 );
$gibson-&gt;set( 'app:count:b', 2 );

$gibson-&gt;keys( 'app:count:' ); // Will return an array with both keys.
</code></pre>

<h3>
<a name="ping" class="anchor" href="#ping"><span class="octicon octicon-link"></span></a>ping</h3>

<hr><p><em><strong>Description</strong></em>: Ping the server instance to refresh client last seen timestamp.</p>

<h5>
<a name="parameters-23" class="anchor" href="#parameters-23"><span class="octicon octicon-link"></span></a><em>Parameters</em>
</h5>

<p>None</p>

<h5>
<a name="return-value-23" class="anchor" href="#return-value-23"><span class="octicon octicon-link"></span></a><em>Return value</em>
</h5>

<p><em>BOOL</em> <code>TRUE</code> in case of success, <code>FALSE</code> in case of failure.</p>

<h5>
<a name="example-24" class="anchor" href="#example-24"><span class="octicon octicon-link"></span></a><em>Example</em>
</h5>

<pre><code>$gibson-&gt;ping(); 
</code></pre>
</article>

<?php include_once 'inc/disqus.php'; ?>
<?php include_once 'inc/footer.php'; ?>
