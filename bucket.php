<?php

$args = explode("&", $_SERVER["QUERY_STRING"]);
if (count($args) === 2) {
    preg_match("/^[-_a-zA-Z0-9\\/.]+$/", $args[0]) or die($args[0]);
    preg_match("/^[-_.a-zA-Z0-9]+$/", $args[1]) or die($args[1]);
    $ch = curl_init("https://data-proxy.ebrains.eu/api/buckets/" . $args[0] ."?delimiter=/&limit=9999");
    curl_setopt_array($ch, array(
//        CURLOPT_HEADER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer " . $args[1]
        )
//        CURLOPT_NOBODY => true
    ));
    curl_exec($ch);
    curl_close($ch);
}
