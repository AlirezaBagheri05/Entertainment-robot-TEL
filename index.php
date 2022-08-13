<?php 

$content = file_get_contents('php://input');

$update = json_decode($content , true);

$chat_id = $update['message']['chat']['id'];
$text = $update['message']['text'];

$url = "https://api.telegram.org/bot5451704513:AAGHBwi8zE2AjnB9wrIcJzzAgRHN0VI5Hy8/sendMessage?chat_id=$chat_id&text=$text";

file_get_contents($url);

?>