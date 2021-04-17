<?php
//apiPost.php

$order = $_POST['data'];
$name = $order['name'];
$drink = $order['drink'];

$array = [
	'id' => 100,
	'name' => $name,
	'drink' => $drink,
];

$json = json_encode($array);
echo $json;


?>