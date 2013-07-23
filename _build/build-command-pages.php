<?php

$commands = file_get_contents( __DIR__ . '/commands.json' );
$commands = json_decode($commands);
$index_fn = realpath( __DIR__."/../" )."/commands.php";
$index    = '<?php $__TITLE = "Commands"; include_once "inc/header.php"; ?>

<article id="topic">
<ul class="breadcrumb">
    <li><a href="/documentation.php">Documentation</a> <span class="divider">/</span></li>
    <li class="active">Command Reference</li>
</ul>
<h1>Command Reference</h1>
<p>
    A list with each command follows.
</p>
<hr/>
<p>
<ul>'.PHP_EOL;
    
foreach( $commands as $cmd => $data ){
    $filename = realpath( __DIR__."/../" )."/command-".strtolower($cmd).".php";

    $content  =  '<?php $__TITLE = "'.$cmd.' command reference"; include_once "inc/header.php"; ?>'.PHP_EOL.
                 '<article id="topic">'.PHP_EOL.
                     '<ul class="breadcrumb">'.PHP_EOL.
                     '     <li><a href="/documentation.php">Documentation</a> <span class="divider">/</span></li>'.PHP_EOL.
                     '     <li><a href="/commands.php">Command Reference</a> <span class="divider">/</span></li>'.PHP_EOL.
                     '     <li class="active">'.$cmd.'</li>'.PHP_EOL.
                     '</ul>'.PHP_EOL.

                 "  <h1>$cmd</h1>".PHP_EOL.
                 '  <p>'.$data->summary.'</p>'.PHP_EOL.
                 '  <hr/>'.PHP_EOL;

    $content  .= '  <p>'.PHP_EOL.
                 '    <h4>Syntax</h4>'.PHP_EOL.
                 '    <pre>'.htmlentities($data->syntax).'</pre>'.PHP_EOL.
                 '  </p>'.PHP_EOL;          

    if( $data->args )
    {
        $content  .= '  <p>'.PHP_EOL.
                     '    <h4>Arguments</h4>'.PHP_EOL.
                     '    <ul>'.PHP_EOL;

        foreach( $data->args as $arg ){
            $content .= "      <li>".PHP_EOL.
                        "          <strong>{$arg->name}</strong> <em>( {$arg->type} )</em> {$arg->desc}".PHP_EOL;
        
            if( isset( $arg->enum ) ){
                $content .= '<br/><em>Valid values:</em>'.PHP_EOL.
                            '<ul>'.PHP_EOL;

                foreach( $arg->enum as $value => $desc ){
                    $content .= "<li><strong>$value</strong>: $desc</li>".PHP_EOL;
                }

                $content .= '</ul>'.PHP_EOL;
            }

            $content .= "      </li>".PHP_EOL;    

        }

        $content  .= '    </ul>'.PHP_EOL.
                     '  </p>'.PHP_EOL;    
    }
    
    if( $data->example )
    {
        $content  .= '   <p>'.PHP_EOL.
                     '      <h4>Example</h4>'.PHP_EOL.
                     '      <pre>'.PHP_EOL;

        foreach( $data->example as $example ){
            $content .= htmlentities($example)."\n";
        }

        $content .= '</pre>'.PHP_EOL.
                    '   </p>'.PHP_EOL;

        if( $data->notes ){
            $content  .= '   <p>'.PHP_EOL.
                         '      <h4>Notes</h4>'.PHP_EOL.
                         '      <ul>'.PHP_EOL;

            foreach( $data->notes as $name => $note ){
                if( is_scalar($note) ){
                    $content .= "<li>$note</li>".PHP_EOL;
                }   
                else {
                    $content .= "<li>$name".PHP_EOL.
                                "<ul>".PHP_EOL;

                    foreach( $note as $key => $value ){
                       $content .= "<li><strong>$key</strong> $value</li>".PHP_EOL;
                    }

                    $content .= "</ul></li>".PHP_EOL;
                }
            }

            $content .= '       </ul>'.PHP_EOL.
                '   </p>'.PHP_EOL;
        }
    }

    $content .= '</article>'.PHP_EOL.
                '<?php include_once "inc/disqus.php"; ?>'.PHP_EOL.
                '<?php include_once "inc/footer.php"; ?>';

    file_put_contents( $filename, $content );

    $index .= "<li><a href=\"/command-".strtolower($cmd).".php\">$cmd</a></li>".PHP_EOL;
}

$index .= '</ul></p>

</article>
<?php include_once "inc/disqus.php"; ?>
<?php include_once "inc/footer.php"; ?>';

file_put_contents( $index_fn, $index );

?>
