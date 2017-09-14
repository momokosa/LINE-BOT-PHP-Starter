<?php
include("func.php");

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];

            if($text == '-help'){
                $text = 'คุณสามารถพิพม์คำสั่งดังต่อไปนี้\r\n -คิดเลข\r\n -แนะนำ';

                // Build message to reply back
    			$messages = [
    				'type' => 'text',
    				'text' => $text
    			];
                send_reply($replyToken, $messages);
            }else {
                $text = 'พิพม์ไรมาอ่ะ(fire) ลองพิพม์ -help ดูสิ';
            }
		}
	}
}
echo "I am a Notto<br>";
echo "json_encode=>".json_encode($events)."<br>";
echo "content=>".$content;
?>
