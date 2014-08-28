<?php
require 'lib/ajox.class.php';
// header('Content-Type: application/json; charset=utf-8');

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

$object = new stdClass();
$object->title = "Some Book Title";
$object->author = "Author Name";
$object->publication = 1978;
$object->umlauts = "הצü";

$AJOX = new AJOX();

// echo $AJOX->array2json($array);
// echo $AJOX->object2json($object);
echo $AJOX->xml2json('lib/data.xml');