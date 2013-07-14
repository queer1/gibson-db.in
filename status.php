<?php $__TITLE = 'Server Status'; include_once 'inc/header.php'; ?>

<article id="topic">

<h1>Server Status</h1>
<p>Gibson status on this server running this website and another three with high traffic rates using Gibson as their main cache backend.</p>
<hr/><br/><br/>
<?php 

$gb = new Gibson();
$gb->pconnect('/var/run/gibson.sock');

$stats = $gb->stats();

$seen = $stats['server_time'];
$now  = time();
$seen = $now - $seen;
$uptime = $now - $stats['server_started'];
$used = format_size( $stats['memory_used'] );
$peak = format_size( $stats['memory_peak'] ); 
$limit = format_size( $stats['memory_usable'] );
$avail = format_size( $stats['memory_available'] );
$iused = $stats['memory_used'];
$ilimit = $stats['memory_usable'];
$fragm = floatval( $stats['memory_fragmentation'] );
$mem_perc = ( 100.0 * $iused ) / $ilimit;

if( ( $history = $gb->get('gbin_24h_history') ) === FALSE ){
	$step = 40;
	
	exec( "grep MEM /var/log/gibson.log | tail -n 5760 | awk '{ print $5 }' | cut -d '/' -f 1 | awk 'NR == 1 || NR % $step == 0'", $history );
	
	foreach( $history as $i => $data ){
		$history[$i] = parse_size( trim($data) );
	}
	
	$gb->set( 'gbin_24h_history', igbinary_serialize( $history ), 3600 );
}
else
	$history = igbinary_unserialize($history);

if( ( $log = $gb->get('gbin_50_log') ) === FALSE ){
	exec( "cat /var/log/gibson.log | tail -n 50", $log );

	$gb->set( 'gbin_50_log', igbinary_serialize( $log ), 1800 );
}
else
	$log = igbinary_unserialize($log);

?>
<p>
<table class="table">
	<tr>
		<td><strong>Status</strong></td>
		<td>
		<?php 
			if( $seen <= 2000 )
				echo '<span class="label label-success">Running</span>';
			
			else
				echo '<span class="label label-important">Not Running</span>';
		?>
		</td>
	</tr>
	<tr>
		<td><strong>Server Version</strong></td>
		<td>
			v<strong><?php echo $stats['server_version']; ?></strong> <small>built on <?php echo $stats['server_build_datetime']; ?> - arch <?php echo $stats['server_arch']; ?>bit</small>
		</td>
	</tr>
	<tr>
		<td><strong>Travis Build</strong></td>
		<td>
            <a href="http://travis-ci.org/evilsocket/gibson">
                <img src="https://secure.travis-ci.org/evilsocket/gibson.png" alt="Build Status" style="max-width:100%;">
            </a>
		</td>
	</tr>
	<tr>
		<td><strong>Uptime</strong></td>
		<td>
		<?php echo format_uptime( $uptime ); ?>
		</td>
	</tr>
        <tr>
		<td><strong>Total Connections</strong></td>
		<td>
		<?php echo $stats['total_connections']; ?>
		</td>
	</tr>
        <tr>
		<td><strong>Total Requests</strong></td>
		<td>
		<?php echo $stats['total_requests']; ?>
		</td>
	</tr>
        <tr>
		<td><strong>Average Requests per Connection</strong></td>
		<td>
		<?php echo (int)$stats['reqs_per_client_avg']; ?>
		</td>
    </tr>
	<tr>
        <td><strong>Currently connected Clients</strong></td>
		<td>
		<?php echo $stats['total_clients']; ?>
		</td>
	</tr>
	<tr>
		<td><strong>System RAM</strong></td>
		<td>
		<?php echo $avail; ?>
		</td>
	</tr>
	<tr>
		<td><strong>RAM Usage</strong></td>
		<td>
		<?php echo $used; ?> out of <?php echo $limit; ?>
		<div class="progress progress-info">		  
		  <div class="bar" style="width: <?php echo $mem_perc; ?>%"></div>
		</div>
		</td>
	</tr>
	<tr>
		<td><strong>Memory Peak</strong></td>
		<td>
		<?php echo format_size( $stats['memory_peak'] ); ?>
		</td>
    </tr>
	<tr>
        <td><strong>Fragmentation Ratio</strong> <small>( RSS / Used )</small></td>
        <td>
            <?php echo $fragm; ?>
		</td>
	</tr>

	<tr>
        <td colspan="2">
            <center>
		    	<img src="//chart.googleapis.com/chart?chf=bg,s,FAFAFA&chs=820x180&cht=lc&chco=3072F3&chds=0,1073741824&chd=t:<?php echo implode( ',', $history ); ?>&chdlp=b&chls=2&chma=5,5,5,25&chtt=Memory+Usage+24h+History&chts=C0C0C0,11.5" width="820" height="180" alt="Memory Usage 24h History" />
            </center>
        </td>
	</tr>
	<tr>
		<td><strong>Total Stored Objects</strong></td>
		<td>
		<?php echo $stats['total_items']; ?>
		</td>
	</tr>
	<tr>
		<td><strong>Compressed Objects</strong></td>
		<td>
		<?php echo $stats['total_compressed_items']; ?>
		</td>
    </tr>
	<tr>
        <td><strong>Average Compression Rate</strong></td>
		<td>
        <?php echo $stats['compr_rate_avg']; ?>%
		<div class="progress progress-info">		  
		  <div class="bar" style="width: <?php echo $stats['compr_rate_avg']; ?>%"></div>
		</div>
		</td>
    </tr>
	<tr>
		<td><strong>Average Object Size</strong></td>
		<td>
		<?php echo format_size( $stats['item_size_avg'] ); ?>
		</td>
	</tr>
</table>
</p>
</article>
<?php 

function format_uptime( $uptime ){
	$days    = 
	$hours   = 
	$minutes = 
	$seconds = 0;
	
	if( $uptime >= 86400 )
	{
		$days = (int)( $uptime / 86400 );
		$uptime %= 86400;
	}
	
	if( $uptime >= 3600 )
	{
		$hours = (int)( $uptime / 3600 );
		$uptime %= 3600;
	}
	
	if( $uptime >= 60 )
	{
		$minutes = (int)( $uptime / 60 );
		$uptime %= 60;
	}
	
	$seconds = $uptime;
	
	return sprintf( "%dd %dh %dm %ds", $days, $hours, $minutes, $seconds );
}

function parse_size( $size ){
	if( strpos( $size, 'GB' ) !== FALSE ){
		return floatval( str_replace( 'GB', '', $size ) ) * 1024 * 1014 * 1024;
	}
	else if( strpos( $size, 'MB' ) !== FALSE ){
		return floatval( str_replace( 'MB', '', $size ) ) * 1024 * 1014;
	}
	else if( strpos( $size, 'KB' ) !== FALSE ){
		return floatval( str_replace( 'KB', '', $size ) ) * 1024;
	}
	else {
		return floatval( $size ) * 1024;
	}
}

function format_size( $size ){
	$suffix = array( "B", "KB", "MB", "GB", "TB" );
	$i = 0;
	$d = $size;
	
	while( $d >= 1024 ){
		$d /= 1024.0;
		++$i;
	}

	return sprintf( "%.1f%s", $d, $suffix[$i] );;
}
?>
<?php include_once 'inc/disqus.php'; ?>
<?php include_once 'inc/footer.php'; ?>
