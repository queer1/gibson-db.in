<?php define( 'BOOT_TIMESTAMP', microtime(TRUE) ); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php if( isset($__TITLE) ): ?>
		<title>Gibson - <?php echo $__TITLE; ?></title>
	<?php else: ?>
		<title>Gibson Cache Server</title>
	<?php endif; ?>
	
	<meta charset="utf-8"/>
	<meta name="language" content="en"/>
	<meta name="title" content="Gibson - A high efficiency, tree based memory cache server."/>
	<meta name="description" content="Gibson is a high efficiency, tree based memory cache server which will boost up your web application performances."/>
	<meta name="keywords" content="gibson, cache, memory, memory cache, server, cache server, gibson server, performance, optimization, tree, btree, nosql"/>
	<meta name="google-site-verification" content="uqqmUCQISZ2oloAGH45pQIVn5eia7nf6vmRY3RJGbF4" />	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta property="og:image" content="http://gibson-db.in/media/logo-105.png"/>
	
	<!-- Twitter Bootstrap -->
	<link href="http://twitter.github.com/bootstrap/assets/css/bootstrap.css" rel="stylesheet">
    <link href="http://twitter.github.com/bootstrap/assets/css/bootstrap-responsive.css" rel="stylesheet">
	<link href="/css/style.css" rel="stylesheet">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
	<link rel="shortcut icon" href="/media/favicon.png" />

</head>
<body>
        <div id="navigation">
            <?php 
                $links = array
                (
                    'Home' => array(
                        'title' => 'Gibson home.',
                        'href'	=> '/index.php'	
                    ),	
                        
                    'Documentation' => array(
                        'title' => 'Gibson documentation.',
                        'href'	=> '/documentation.php'	
                    ),	
                        
                    'Download' => array(
                        'title' => 'Download Gibson source code and binary release.',
                        'href'	=> '/download.php'
                    ),
                        
                    'Blog' => array(
                        'title' => 'Development blog.',
                        'href'	=> '/blog/'
                    ),
                        
                    'Mailing List' => array(
                        'title' => 'Mailing List',
                        'href'	=> 'https://groups.google.com/group/gibson-cache-server'	
                    ),

                    'Issues' => array(
                        'title' => 'Gibson issue manager.',
                        'href'	=> 'https://github.com/evilsocket/gibson/issues'
                    ),		

                    'Server Status' => array(
                            'title' => 'Gibson status on this server.',
                            'href'	=> '/status.php'
                        )                
                );

            ?>
            <ul>
                <?php foreach( $links as $link => $data ): ?>
                <?php 
                    $active = ( stripos( $_SERVER["REQUEST_URI"], $data['href'] ) === 0 ) ||
                              ( $_SERVER["REQUEST_URI"] == '/' && $data['href'] == '/index.php' );
                
                ?>
                <li<?php if( $active ) echo " class=\"active\""; ?>>
                    <a href="<?php echo $data['href']; ?>" title="<?php echo $data['title']; ?>"><?php echo $link; ?></a>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>

<div class="container">
	<div class="wrapper">
