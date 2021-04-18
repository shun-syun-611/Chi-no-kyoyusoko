<?php
// api.php
$array =[
    [
        "id" => 0,
        "name" => "ヤマガミ",
        "drink" => "ビール",
    ],
    [
        "id" => 1,
        "name" => "ケンモク",
        "drink" => "コーヒー",
    ],
];
// 配列($array)をJSONに変換(エンコード)する
$json = json_encode($array);
echo $json;

