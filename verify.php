<?php
$access_token = 'b5NIe+AmHsUw6aoq34PCfh7BcMvLmnBLSfChxMQ9FWEP+nFEHJa0ruMwlAsbN7mx+pvjWtI9XJfqJQMXo2fPtwjrz9CAYU3QCByxlGfxJd7chzoK5epq5iz8kmVk7skET1SylofkmY4ZWkwtAcol5gdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
