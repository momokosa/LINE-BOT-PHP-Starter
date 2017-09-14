<?php
require("func.php");

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
                $text = '0x100096 คุณสามารถพิพม์คำสั่งดังต่อไปนี้\n -คิดเลข\n -แนะนำ';

                // Build message to reply back
    			$messages = [
    				'type' => 'text',
    				'text' => $text
    			];
                send_reply($replyToken, $messages);
            }else {
                $text = 'พิพม์ไรมาอ่ะ 0x100096 ลองพิพม์ -help ดูสิ';
                $messages = [
    				'type' => 'text',
    				'text' => $text
    			];
                send_reply($replyToken, $messages);
            }
		}
	}
}
echo "I am a Notto<br>";
echo "json_encode=>".json_encode($events)."<br>";
echo "content=>".$content;
?>
