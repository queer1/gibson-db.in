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
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,400,600,700,900,400italic,700italic,900italic" media="screen" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Archivo+Narrow:400,400italic,700italic,700" media="screen" rel="stylesheet" type="text/css" />

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

            <div id="right-nav">
                <iframe class="github-btn" src="http://ghbtns.com/github-btn.html?user=evilsocket&repo=gibson&type=watch&count=true" allowtransparency="true" frameborder="0" scrolling="0" width="100px" height="20px"></iframe>  

                <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://gibson-db.in/" data-text="Gibson Cache Server" data-via="evilsocket" data-lang="it" data-dnt="true">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
            
 
            </div>
        </div>

<div class="container">
	<div class="wrapper">
