<?php $__TITLE = 'Trie Data Structure'; include_once 'inc/header.php'; ?>

<article id="topic">
<ul class="breadcrumb">
    <li><a href="/documentation.php">Documentation</a> <span class="divider">/</span></li>
    <li class="active">Data Structure</li>
</ul>
    <h1>Gibson Data Structure, the Trie</h1>

    <p>
        <small>Most of the content of this document was taken from <a href="http://en.wikipedia.org/wiki/Trie" target="_blank">this page</a> on Wikipedia.</small>
    </p>
    <hr/>
    <p>Unlike many other key value stores, Gibson doesn't use a hash table as its main data structure, but a special type of tree called <strong>Trie</strong></p>

    <p>In computer science, a trie, also called digital tree or prefix tree, is an ordered tree data structure that is used to store a dynamic set or associative array where the keys are usually strings. Unlike a binary search tree, no node in the tree stores the key associated with that node; instead, its position in the tree defines the key with which it is associated. All the descendants of a node have a common prefix of the string associated with that node, and the root is associated with the empty string. Values are normally not associated with every node, only with leaves and some inner nodes that correspond to keys of interest. For the space-optimized presentation of prefix tree, see compact prefix tree.</p>

    <p>The term trie comes from retrieval. This term was coined by Edward Fredkin, who pronounces it /ˈtriː/ "tree" as in the word retrieval.</p>

    <p>In the example shown, keys are listed in the nodes and values below them. Each complete English word has an arbitrary integer value associated with it. A trie can be seen as a deterministic finite automaton, although the symbol on each edge is often implicit in the order of the branches.</p>

    <p>It is not necessary for keys to be explicitly stored in nodes. (In the figure, words are shown only to illustrate how the trie works.)</p>

    <p>Though tries are most commonly keyed by character strings, they need not be. The same algorithms can easily be adapted to serve similar functions of ordered lists of any construct, e.g., permutations on a list of digits or shapes. In particular, a bitwise trie is keyed on the individual bits making up a short, fixed size of bits such as an integer number or memory address.</p>

    <center>
        <img src="http://upload.wikimedia.org/wikipedia/commons/thumb/b/be/Trie_example.svg/250px-Trie_example.svg.png" style="display:block; margin: 0 auto;"/>
        <small>A trie for keys "A", "to", "tea", "ted", "ten", "i", "in", and "inn".</small>
    </center>

    <h3>Advantages over a Hash Table</h3>

    <p>A trie can be used to replace a hash table, over which it has the following advantages:</p>

<ul>
<li>Looking up data in a trie is faster in the worst case, O(m) time (where m is the length of a search string), compared to an imperfect hash table. An imperfect hash table can have key collisions. A key collision is the hash function mapping of different keys to the same position in a hash table. The worst-case lookup speed in an imperfect hash table is O(N) time, but far more typically is O(1), with O(m) time spent evaluating the hash.</li>
<li>There are no collisions of different keys in a trie.</li>
<li>Buckets in a trie which are analogous to hash table buckets that store key collisions are necessary only if a single key is associated with more than one value.</li>
<li>There is no need to provide a hash function or to change hash functions as more keys are added to a trie.</li>
<li>A trie can provide an alphabetical ordering of the entries by key.</li>
</ul>

<p>Tries do have some drawbacks as well:</p>

    <ul>
        <li>Tries can be slower in some cases than hash tables for looking up data, especially if the data is directly accessed on a hard disk drive or some other secondary storage device where the random-access time is high compared to main memory. ( <strong>Not in the Gibson case</strong> )</li>
<li>Some keys, such as floating point numbers, can lead to long chains and prefixes that are not particularly meaningful. Nevertheless a bitwise trie can handle standard IEEE single and double format floating point numbers. ( <strong>Not in the Gibson case</strong> )</li>
<li>Some tries can require more space than a hash table, as memory may be allocated for each character in the search string, rather than a single chunk of memory for the whole entry, as in most hash tables.</li>
</ul>

<p>For more details refer to <a href="http://en.wikipedia.org/wiki/Trie" target="_blank">this Wikipedia page</a>.</p>

</article>
<?php include_once 'inc/disqus.php'; ?>
<?php include_once 'inc/footer.php'; ?>
