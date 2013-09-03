---
layout: post
title: Finally Gibson data structure has a name!
categories:
- Dev Diary
tags:
- algorithms
- bst
- comparision
- data structure
- dst
- hash table
- index
- indexing
- string
- strings
- tree
- trie
status: publish
type: post
published: true
---

I'm a more practical guy than theoretical, most of it because i have no formal education in computer science.
Everything i do, everything i know is just a long series ( more than ten years! ) of hit and misses _aka_ practicing.
When i've imagined and developed the data structure which is behind Gibson ( actually it was during another project called Hybris ... but that's another story ) i had absolutely no idea of what its name was and if anyone else already invented it, so i just called it **a tree** ( because it IS a tree ) during many years.
Recently I'm studying some books about algorithms, complexity and data structures and today one of the last chapter of the book I was reading took my attention ... that was exactly the data structure Gibson uses, a **Trie**!

Now a little bit of formal details.

<small>Most of the content of this document was taken from [this page](http://en.wikipedia.org/wiki/Trie) on Wikipedia.</small>

Unlike many other key value stores, Gibson doesn't use a hash table as its main data structure, but a special type of tree called **Trie**

In computer science, a trie, also called digital tree or prefix tree, is an ordered tree data structure that is used to store a dynamic set or associative array where the keys are usually strings. Unlike a binary search tree, no node in the tree stores the key associated with that node; instead, its position in the tree defines the key with which it is associated. All the descendants of a node have a common prefix of the string associated with that node, and the root is associated with the empty string. Values are normally not associated with every node, only with leaves and some inner nodes that correspond to keys of interest. For the space-optimized presentation of prefix tree, see compact prefix tree.

The term trie comes from retrieval. This term was coined by Edward Fredkin, who pronounces it /ˈtriː/ "tree" as in the word retrieval.

In the example shown, keys are listed in the nodes and values below them. Each complete English word has an arbitrary integer value associated with it. A trie can be seen as a deterministic finite automaton, although the symbol on each edge is often implicit in the order of the branches.

It is not necessary for keys to be explicitly stored in nodes. (In the figure, words are shown only to illustrate how the trie works.)

Though tries are most commonly keyed by character strings, they need not be. The same algorithms can easily be adapted to serve similar functions of ordered lists of any construct, e.g., permutations on a list of digits or shapes. In particular, a bitwise trie is keyed on the individual bits making up a short, fixed size of bits such as an integer number or memory address.

<center>
    ![](http://upload.wikimedia.org/wikipedia/commons/thumb/b/be/Trie_example.svg/250px-Trie_example.svg.png)
    <small>A trie for keys "A", "to", "tea", "ted", "ten", "i", "in", and "inn".</small>
</center>

### Advantages over a Hash Table

A trie can be used to replace a hash table, over which it has the following advantages:

* Looking up data in a trie is faster in the worst case, O(m) time (where m is the length of a search string), compared to an imperfect hash table. An imperfect hash table can have key collisions. A key collision is the hash function mapping of different keys to the same position in a hash table. The worst-case lookup speed in an imperfect hash table is O(N) time, but far more typically is O(1), with O(m) time spent evaluating the hash.
* There are no collisions of different keys in a trie.
* Buckets in a trie which are analogous to hash table buckets that store key collisions are necessary only if a single key is associated with more than one value.
* There is no need to provide a hash function or to change hash functions as more keys are added to a trie.
* A trie can provide an alphabetical ordering of the entries by key.

Tries do have some drawbacks as well:

* Tries can be slower in some cases than hash tables for looking up data, especially if the data is directly accessed on a hard disk drive or some other secondary storage device where the random-access time is high compared to main memory. ( **Not in the Gibson case** )
* Some keys, such as floating point numbers, can lead to long chains and prefixes that are not particularly meaningful. Nevertheless a bitwise trie can handle standard IEEE single and double format floating point numbers. ( **Not in the Gibson case** )
* Some tries can require more space than a hash table, as memory may be allocated for each character in the search string, rather than a single chunk of memory for the whole entry, as in most hash tables.


