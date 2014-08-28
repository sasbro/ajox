<?php
require 'lib/ajox.class.php';

echo '<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body>';

$json = '{"a":1,"b":2,"c":3,"d":"4","e":"ה"}';

$object = new stdClass();
$object->title = "Some Book Title";
$object->author = "Author Name";
$object->publication = 1978;
$object->umlauts = "הצü";

$AJOX = new AJOX();

print_r($AJOX->json2array($json));
// print_r($AJOX->object2array($object));
// print_r($AJOX->xml2array('lib/data.xml'));

echo '</body></html>';



































