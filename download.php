<?php $__TITLE = 'Download'; include_once 'inc/header.php'; ?>

<article id="topic">

<h1>Compilation and Installation</h1>

<p>
Gibson source code release can be found <a href="https://github.com/evilsocket/gibson" title="Gibson source code">here</a>. In order to compile it, you will need cmake and autotools installed, then:
</p>

<p>
<pre>
$ cd /path/to/gibson-source/
$ cmake . [compilation options]
$ make
# make install
</pre>
</p>

<p>
<br/>
Where <strong>compilation options</strong> might be:

<br/>
<pre>-DWITH_DEBUG=1</pre>

To compile with debug symbols and without optimizations ( for devs ).

<br/>
<pre>-DWITH_JEMALLOC=1</pre>

To use the <a href="/blog/gibson-is-now-optionally-jemalloc-powered.html">jemalloc memory allocator</a> instead of the standard one.
</p>

<br/><br/>

<p>
If you want to edit its default configuration, please refer to the <a href="/documentation.php">documentation</a>.
</p>
</article>
<?php include_once 'inc/disqus.php'; ?>
<?php include_once 'inc/footer.php'; ?>
