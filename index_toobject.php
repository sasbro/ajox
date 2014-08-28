<?php
require 'lib/ajox.class.php';

echo '<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body>';

$array = array(
    "a",
    "b",
    "c",
    "aou" => "הצü",
    array(
        "aa" => 2,
        "bb" => 4
    ),
    array(
        array(
            1,
            "2",
            "three" => "4"
        )
    )
);

$json = '{"a":1,"b":2,"c":3,"d":"4","e":"ה"}';

$AJOX = new AJOX();

// print_r($AJOX->array2object($array));
// print_r($AJOX->json2object($json));
print_r($AJOX->xml2object('lib/data.xml'));

echo '</body></html>';