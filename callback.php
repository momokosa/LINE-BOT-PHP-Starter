<?php

$channel_secret = '385d3664dac0c44875994b2c3552da21';
$channel_token = 'b5NIe+AmHsUw6aoq34PCfh7BcMvLmnBLSfChxMQ9FWEP+nFEHJa0ruMwlAsbN7mx+pvjWtI9XJfqJQMXo2fPtwjrz9CAYU3QCByxlGfxJd7chzoK5epq5iz8kmVk7skET1SylofkmY4ZWkwtAcol5gdB04t89/1O/w1cDnyilFU=';
define("LINE_MESSAGING_API_CHANNEL_SECRET", $channel_secret);
define("LINE_MESSAGING_API_CHANNEL_TOKEN", $channel_token);

require __DIR__."/vendor/autoload.php";

$bot = new \LINE\LINEBot(
    new \LINE\LINEBot\HTTPClient\CurlHTTPClient(LINE_MESSAGING_API_CHANNEL_TOKEN),
    ['channelSecret' => LINE_MESSAGING_API_CHANNEL_SECRET]
);

$signature = $_SERVER["HTTP_".\LINE\LINEBot\Constant\HTTPHeader::LINE_SIGNATURE];
$body = file_get_contents("php://input");

$events = $bot->parseEventRequest($body, $signature);

foreach ($events as $event) {
    if ($event instanceof \LINE\LINEBot\Event\MessageEvent\TextMessage) {
        $reply_token = $event->getReplyToken();
        $text = $event->getText();
        $bot->replyText($reply_token, $text);
    }
}

echo "OK";

ob_start();
$raw = file_get_contents('php://input');
var_dump(json_decode($raw,1));
$raw = ob_get_clean();
file_put_contents('/tmp/dump.txt', $raw."\n=====================================\n", FILE_APPEND);

echo "OK";
?>
