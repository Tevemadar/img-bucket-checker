<?php

$pos = strpos($_SERVER["QUERY_STRING"], "&") or die("&?");
$token = substr($_SERVER["QUERY_STRING"],0,$pos);
$url=substr($_SERVER["QUERY_STRING"],$pos+1);
preg_match("/^[-_.a-zA-Z0-9]+$/", $token) or die($token);
$cscs = strpos($url, "https://object.cscs.ch/v1/AUTH_") === 0;
$cscs or strpos($url, "https://data-proxy.ebrains.eu/api/v1/") === 0 or die($url);

$ch = curl_init($url);
curl_setopt_array($ch, array(
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTPHEADER => array(
//        $cscs?"":"Authorization: Bearer " . $token
    )
));
curl_exec($ch);
curl_close($ch);
