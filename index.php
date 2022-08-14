<?php 
require_once('env.php');
require_once('LibTelegram.php');
require_once('lib.php');
require_once('functions.php');

$content = file_get_contents('php://input');
$update = json_decode($content , true);
$chat_id = $update['message']['chat']['id'];
$user_name = $update['message']['from']['first_name'];
$text = $update['message']['text'];

$made_jock = search_strings($text,'جک یاد بگیر');
$made_poem = search_strings($text,'شعر یاد بگیر');

$value = new lib(SERVER_NAME,USER_NAME,USER_PASSWORD,DB_NM);

if($text == '/jock'){
    $max = $value->count(JBOT);
    $id = rand(1,$max);
    $txt = $value->select_jock($id);
    if($txt){
        $text = $txt['value'];
    }else{
        $text = 'حافظم پاک شده. بهم یاد بده 🥲';
    }
}
else if($text == '/poem'){
    $max = $value->count(PBOT);
    $id = rand(1,$max);
    $txt = $value->select_poem($id);
    if($txt){
        $text = $txt['value'];
    }else{
        $text = 'حافظم پاک شده. بهم یاد بده 🥲';
    }
}
else if($text == '/poem_maker'){
    $text = "راهنما🐶\nفقط کافیه اول جملت کلمه 'شعر یاد بگیر' رو بزاری😍\n\nمثلا\nشعر یاد بگیر امیر گر شود خمیر به امیرعلی ربطی ندارع😐😐🤣";
}
else if($text == '/jock_maker'){
    $text = "راهنما🐶\nفقط کافیه اول جملت کلمه 'جک یاد بگیر' رو بزاری😍\n\nمثلا\nجک یاد بگیر امیر خورد به امین خمیر شد😂😐";
}
else if($made_jock){
    $text =  str_replace('جک یاد بگیر',"",$text);
    $name = "jock";
    $txt = $value->insert_jock($name,$text,$user_name);
    if($txt){
        $text = 'باموفقیت ثبت شد';
    }else{
        $text = 'متاسفانه ثبت نشد';
    }
}
else if($made_poem){
    $text =  str_replace('شعر یاد بگیر',"",$text);
    $name = "poem";
    $txt = $value->insert_poem($name,$text,$user_name);
    if($txt){
        $text = 'باموفقیت ثبت شد';
    }else{
        $text = 'متاسفانه ثبت نشد';
    }
}
else if($text == '/start'){
    $text = "به اولین ربات من خوش اومديد😍\n\nاین ربات قادر به ارسال جک و شعر میباشد🙃❤️\nو همچنین میتونید بهش شعر و جک هم یاد بدید🤩";
}else{
    $text ="دستور وارد شده صحیح نمیباشد";
}

$parametrs = array(
    'chat_id'=>$chat_id,
    'text'=>$text
);
$firstbot = new bot_telegram(API_URL1);
$firstbot->sendMessage('sendMessage',$parametrs);

?>