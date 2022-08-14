<?php 
require_once('env.php');
require_once('LibTelegram.php');

$content = file_get_contents('php://input');
$update = json_decode($content , true);
$chat_id = $update['message']['chat']['id'];
$text = $update['message']['text'];

$parametrs = array(
    'chat_id'=>$chat_id,
    'text'=>$text
);
$firstbot = new bot_telegram(API_URL);
$result = $firstbot->sendMessage('sendMessage',$parametrs);
print_r($result);

?>