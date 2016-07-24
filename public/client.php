<?php
$product = ['id' => 4];

$ch = curl_init('http://test/api/product/list');
//curl_setopt($ch, CURLOPT_POST, true);
//curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($product));
curl_exec($ch);