<?php
////////BENCHAMIN LOUIS//////
//CHANNEL:- T.ME/INDUSBOTS////
error_reporting(0);

set_time_limit(0);

flush();
$API_KEY = $_ENV['BOT_TOKEN']; 
##------------------------------##
define('API_KEY',$API_KEY);
function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}
 function sendmessage($chat_id, $text, $model){
	bot('sendMessage',[
	'chat_id'=>$chat_id,
	'text'=>$text,
	'parse_mode'=>$mode
	]);
	}
	function sendaction($chat_id, $action){
	bot('sendchataction',[
	'chat_id'=>$chat_id,
	'action'=>$action
	]);
	}
//==============BENCHAM======================//
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$message_id = $update->message->id;
$chat_id = $message->chat->id;
$name = $from_id = $message->from->first_name;
$from_id = $message->from->id;
$text = $message->text;
$fromid = $update->callback_query->from->id;
$username = $update->message->from->username;
$chatid = $update->callback_query->message->chat->id;
$callback_query = $update->callback_query->data;
$messageid = $update->callback_query->message->message_id;
$reply = $update->message->reply_to_message->message_id;
$START_MESSAGE = $_ENV['START_MESSAGE'];
//===============BENCHAM=============//
if ($text == "/start") {

            bot('sendmessage', [
                'chat_id' =>$chat_id,
                'text' =>"***$START_MESSAGE

Use*** `/iban xxxxx` ***to check bin on bin-su.***",
 'parse_mode'=>'MarkDown',
            
        ]);
 }if(strpos($text,"/iban") !== false){ 
$bin = trim(str_replace("/iban","",$text)); 

$data = json_decode(file_get_contents("https://openiban.com/validate/$Domain?getBIC=true&validateBankCode=true"),true);
$value = $data['valid'];
$indusbots1 = $data['iban'];
$indusbots2 = $data['bankData']['bankCode'];
$indusbots3 = $data['bankData']['name'];
$indusbots4 = $data['bankData']['bic'];
$indusbots5 = $data['messages'][0];

 if($data['valid']){
bot('sendmessage', [
                'chat_id' =>$chat_id,
                'text' =>"***VALID iban✅
               
➤ Bɪɴ : $indusbots1

➤ Tʏᴘᴇ : $indusbots2

➤ Bʀᴀɴᴅ : $indusbots3

➤ Bᴀɴᴋ : $indusbots4

➤ Cᴏᴜɴᴛʀʏ : $indusbots5


🔺BIN CHECKED FROM DATABASE OF BIN-SU🔻***",
'parse_mode'=>"MarkDown",
]);
    }
else {
bot('sendmessage', [
                'chat_id' =>$chat_id,
                'text' =>"INVALID BIN❌",
               
]);
}
}

?>
