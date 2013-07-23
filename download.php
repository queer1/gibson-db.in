<?php $__TITLE = 'Download'; include_once 'inc/header.php'; ?>

<article id="topic">
<ul class="breadcrumb">
    <li><a href="/documentation.php">Documentation</a> <span class="divider">/</span></li>
    <li class="active">Compilation</li>
</ul>

<h1>Compilation and Installation</h1>
<p>Gibson is still hosted as source code release on Github, in order to run it you will have to compile sources, therefore you will need <strong>git</strong>, <strong>cmake</strong>, <strong>gcc</strong> and <strong>build-essential</strong> packages installed on your computer.</p>
<hr/>

<h4>Clone/Download</h4>
<p>
You have two options to obtain the source code, one is cloning the github repository using git:

<pre>git clone https://github.com/evilsocket/gibson.git</pre>

Or you can download the source code archive <a href="https://github.com/evilsocket/gibson/archive/unstable.zip">from here</a>.
</p>

<h4>Compiling</h4>
<p>
Once you got the source code, all you have to do is compile Gibson, the process is pretty straightforward.
<pre>
$ cd gibson
$ cmake . [compilation options]
$ make
# make install
</pre>
</p>

<p>
<br/>
Where <strong>compilation options</strong> might be:

<br/>
<pre>-DPREFIX=/your/custom/prefix</pre>

To use a different installation prefix rather than <em>/usr</em> .

<br/>
<pre>-DWITH_DEBUG=1</pre>

To compile with debug symbols and without optimizations ( for devs ).

<br/>
<pre>-DWITH_JEMALLOC=1</pre>

To use the <a href="/blog/gibson-is-now-optionally-jemalloc-powered.html">jemalloc memory allocator</a> instead of the standard one.
</p>

<br/><br/>

<p>
If you want to edit the default configuration, please refer to the <a href="/documentation.php">documentation</a>.
</p>
</article>
<?php include_once 'inc/disqus.php'; ?>
<?php include_once 'inc/footer.php'; ?>
