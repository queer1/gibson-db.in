---
layout: default
title: Protocol Specifications.
---

# Protocol Specifications

Gibson uses a binary protocol, this means every field of the query is packed into bytes in a binary form. Even if this doesn't allow
the user to easily play with the server using tools like telnet or netcat ( you should use perl or something similar to encode a query 
first ), on the other hand is an optimized approach to reduce query parsing times.

After a client connection, every query to a Gibson instance is formed by 4 bytes heading with the whole query length, followed by
two bytes of query op code and finally the data which is query specific.

<table width="100%" cellpadding="0" cellspacing="0" class="table table-bordered packet">
	<tr>
		<td>0</td>
		<td>1</td>
		<td>2</td>
		<td>3</td>
		<td>4</td>
		<td>5</td>
		<td>...</td>
	</tr>
	<tr>
		<td colspan="4">query length</td>
		<td colspan="2">op code</td>
		<td>query data</td>
	</tr>
</table>

For instance, a "[GET](http://gibson-db.in/phpgibson.html#get) foo" query packet will be:

<table width="100%" cellpadding="0" cellspacing="0" class="table table-bordered packet">
	<tr>
		<td>0</td>
		<td>1</td>
		<td>2</td>
		<td>3</td>
		<td>4</td>
		<td>5</td>
		<td>6</td>
		<td>7</td>
		<td>8</td>
	</tr>
	<tr>
		<td colspan="4">5</td>
		<td colspan="2">0x03</td>
		<td>f</td>
		<td>o</td>
		<td>o</td>
	</tr>
</table>

Where 5 is sizeof(op code) ( which is an unsigned short, hence 2 bytes ) plus sizeof(foo) which is 3 bytes long.  

The op codes are defined in the [query.h](https://github.com/evilsocket/gibson/blob/unstable/src/query.h#L41) header file, the following table shows what 
every operation should contain in the **query data** field to be succesfully parsed and executed.

<table width="100%" cellpadding="0" cellspacing="0" class="table table-bordered">
	<tr>
		<td width="10%">**Query**</td>
		<td width="10%">**Op Code**</td>
		<td>**Query Data**</td>
		<td>**Example**</td>
	</tr>
	<tr>
		<td>OP_SET</td>
		<td>0x01</td>
		<td>TTL KEY VALUE</td>
		<td>3600 foo bar</td>
	</tr>
	<tr>
		<td>OP_TTL</td>
		<td>0x02</td>
		<td>TTL KEY</td>
		<td>3600 foo</td>
	</tr>
	<tr>
		<td>OP_GET</td>
		<td>0x03</td>
		<td>KEY</td>
		<td>foo</td>
	</tr>
	<tr>
		<td>OP_DEL</td>
		<td>0x04</td>
		<td>KEY</td>
		<td>foo</td>
	</tr>
	<tr>
		<td>OP_INC</td>
		<td>0x05</td>
		<td>KEY</td>
		<td>foo</td>
	</tr>
	<tr>
		<td>OP_DEC</td>
		<td>0x06</td>
		<td>KEY</td>
		<td>foo</td>
	</tr>
	<tr>
		<td>OP_LOCK</td>
		<td>0x07</td>
		<td>KEY TIME</td>
		<td>foo 3600</td>
	</tr>
	<tr>
		<td>OP_UNLOCK</td>
		<td>0x08</td>
		<td>KEY</td>
		<td>foo</td>
	</tr>
	<tr>
		<td>OP_MSET</td>
		<td>0x09</td>
		<td>PREFIX VALUE</td>
		<td>f bar</td>
	</tr>
	<tr>
		<td>OP_MTTL</td>
		<td>0x0A</td>
		<td>PREFIX TTL</td>
		<td>f 3600</td>
	</tr>
	<tr>
		<td>OP_MGET</td>
		<td>0x0B</td>
		<td>PREFIX</td>
		<td>f</td>
	</tr>
	<tr>
		<td>OP_MDEL</td>
		<td>0x0C</td>
		<td>PREFIX</td>
		<td>f</td>
	</tr>
	<tr>
		<td>OP_MINC</td>
		<td>0x0D</td>
		<td>PREFIX</td>
		<td>f</td>
	</tr>
	<tr>
		<td>OP_MDEC</td>
		<td>0x0E</td>
		<td>PREFIX</td>
		<td>f</td>
	</tr>
	<tr>
		<td>OP_MLOCK</td>
		<td>0x0F</td>
		<td>PREFIX TIME</td>
		<td>f 3600</td>
	</tr>
	<tr>
		<td>OP_MUNLOCK</td>
		<td>0x10</td>
		<td>PREFIX</td>
		<td>f</td>
	</tr>
	<tr>
		<td>OP_COUNT</td>
		<td>0x11</td>
		<td>PREFIX</td>
		<td>f</td>
	</tr>
	<tr>
		<td>OP_STATS</td>
		<td>0x12</td>
		<td>_empty_</td>
		<td>_empty_</td>
	</tr>
	<tr>
		<td>OP_PING</td>
		<td>0x13</td>
		<td>_empty_</td>
		<td>_empty_</td>
	</tr>
	<tr>
		<td>OP_META</td>
		<td>0x14</td>
		<td>KEY METANAME</td>
		<td>foo encoding</td>
  </tr>
	<tr>
		<td>OP_KEYS</td>
		<td>0x15</td>
		<td>PREFIX</td>
		<td>f</td>
	</tr>
	<tr>
		<td>OP_END</td>
		<td>0xFF</td>
		<td>_empty_</td>
		<td>_empty_</td>
	</tr>
</table>

Once the query gets executed, the server will reply with the following packet structure.

<table width="100%" cellpadding="0" cellspacing="0" class="table table-bordered packet">
	<tr>
		<td>0</td>
		<td>1</td>

		<td>2</td>

		<td>3</td>
		<td>4</td>
		<td>5</td>
		<td>6</td>

		<td>...</td>
	</tr>
	<tr>
		<td colspan="2">code</td>
		<td>encoding</td>
		<td colspan="4">data size</td>
		<td>data</td>
	</tr>
</table>

Or, if a **REPL_KVAL** reply code is specified, with the following.

<table width="100%" cellpadding="0" cellspacing="0" class="table table-bordered packet">
	<tr>
		<td>0</td>
		<td>1</td>

		<td>2</td>

		<td>3</td>
		<td>4</td>
		<td>5</td>
		<td>6</td>

    <td>7</td>
		<td>8</td>
		<td>9</td>
		<td>10</td>

		<td>...</td>
	</tr>
	<tr>
		<td colspan="2">code</td>
		<td>encoding <small>( GB_ENC_PLAIN for KVAL )</small></td>
		<td colspan="4">data size</td>
		<td colspan="4">number of elements</td>
		<td>multiple key =&gt; value data</td>
	</tr>
</table>

The **code** field contains the two bytes reply code as defined in the [query.h](https://github.com/evilsocket/gibson/blob/unstable/src/query.h#L67)
header file.  

<table width="100%" cellpadding="0" cellspacing="0" class="table table-bordered">
	<tr>
		<td width="10%">**Reply**</td>
		<td width="10%">**Code**</td>
		<td>**Description**</td>
	</tr>
	<tr>
		<td>REPL_ERR</td>
		<td>0x00</td>
		<td>Generic error while executing the query.</td>
	</tr>
	<tr>
		<td>REPL_ERR_NOT_FOUND</td>
		<td>0x01</td>
		<td>Specified key was not found.</td>
	</tr>
	<tr>
		<td>REPL_ERR_NAN</td>
		<td>0x02</td>
		<td>Expected a number ( TTL or TIME ) but the specified value was invalid.</td>
	</tr>
	<tr>
		<td>REPL_ERR_MEM</td>
		<td>0x03</td>
		<td>
		The server reached configuration memory limit and will not accept any new value until its
		freeing routine will be executed.
		</td>
	</tr>
	<tr>
		<td>REPL_ERR_LOCKED</td>
		<td>0x04</td>
		<td>The specificed key was locked by a OP_LOCK or a OP_MLOCK query.</td>
	</tr>
	<tr>
		<td>REPL_OK</td>
		<td>0x05</td>
		<td>Query succesfully executed, no data follows.</td>
	</tr>
	<tr>
		<td>REPL_VAL</td>
		<td>0x06</td>
		<td>Query succesfully executed, value data follows.</td>
	</tr>
	<tr>
		<td>REPL_KVAL</td>
		<td>0x07</td>
		<td>Query succesfully executed, multiple key =&gt; value data follows.</td>
	</tr>
</table>

The **encoding** field specifies how the data ( which is present only if REPL_VAL is specified ) is encoded, if it's a four/eight bytes ( according to server
architecture ) data packet representing a number, or a raw data packet with a string value in it.  

<table width="100%" cellpadding="0" cellspacing="0" class="table table-bordered">
	<tr>
		<td width="10%">**Encoding**</td>
		<td width="10%">**Code**</td>
		<td>**Description**</td>
	</tr>
	<tr>
		<td>GB_ENC_PLAIN</td>
		<td>0x00</td>
		<td>Raw string data follows.</td>
	</tr>
	<tr>
		<td>GB_ENC_LZF</td>
		<td>0x01</td>
		<td>Compressed data, this is a **reserved** value not used for replies.</td>
	</tr>
	<tr>
		<td>GB_ENC_NUMBER</td>
		<td>0x02</td>
		<td>Packed **long** number follows, four bytes for 32bit architectures, eight bytes for 64bit.</td>
	</tr>
</table>

For a **REPL_KVAL** reply we have a four bytes field instead of the encoding two bytes, representing the number of elements
which follows in the data field.
Every element of a key =&gt; value set is encoded as a sequence of the following packet.  

<table width="100%" cellpadding="0" cellspacing="0" class="table table-bordered packet">
	<tr>
		<td>0</td>
		<td>1</td>
		<td>2</td>
		<td>3</td>

		<td>N</td>

		<td>N + 1</td>

		<td>N + 2</td>
		<td>N + 3</td>
		<td>N + 4</td>
		<td>N + 5</td>

		<td>...</td>
	</tr>
	<tr>
		<td colspan="4">key size</td>
		<td>key</td>
		<td>value encoding</td>
		<td colspan="4">value size</td>
		<td>value</td>
	</tr>
</table>

Where N = key size, the encoding uses the same standard as a REPL_VAL reply, and the value is encoded accordingly.