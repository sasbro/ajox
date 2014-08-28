<?php
require 'lib/ajox.class.php';
// header('Content-Type: application/xml; charset=utf-8');

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

$object = new stdClass();
$object->title = "Some Book Title";
$object->author = "Author Name";
$object->publication = 1978;
$object->umlauts = "הצü";

$AJOX = new AJOX();

// echo $AJOX->array2xml($array);
// echo $AJOX->array2xml($array, 'data.xml');
echo $AJOX->json2xml($json);
// echo $AJOX->obj2xml($object);