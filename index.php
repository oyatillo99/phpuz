<?php 

// token maydoni
define('bot_token','832354568:AAF-0KaBTXkrQF7eY18Bk5_jOTxK8usfpDk');

    function xabarYubor(array $content)
    {
        return endpoint('sendMessage', $content);
    }

    function buildKeyBoard(array $options, $onetime = false, $resize = true, $selective = true)
    {
        $replyMarkup = [
            'keyboard'          => $options,
            'one_time_keyboard' => $onetime,
            'resize_keyboard'   => $resize,
            'selective'         => $selective,
        ];
        $encodedMarkup = json_encode($replyMarkup, true);
        return $encodedMarkup;
    }

    function endpoint($api, array $content, $post = true)
    {
        $url = 'https://api.telegram.org/bot'.bot_token.'/'.$api;
        if ($post) {
            $reply = sendAPIRequest($url, $content);
        } else {
            $reply = sendAPIRequest($url, [], false);
        }
        return json_decode($reply, true);
    }

    function sendAPIRequest($url, array $content, $post = true)
    {
        if (isset($content['chat_id'])) {
            $url = $url.'?chat_id='.$content['chat_id'];

            //$url = $url.'?'.http_build_query($content);

            unset($content['chat_id']);
            //unset($content);
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if ($post) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
        }
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        if ($result === false) {
            $result = json_encode(['ok'=>false, 'curl_error_code' => curl_errno($ch), 'curl_error' => curl_error($ch)]);
        }
        curl_close($ch);
        return $result;
    }


// uzizni ID raqamingizni kiritasiz
$admin = "777777";

// BOT iz username si
$bot_name = "@idFox";


$efede = json_decode(file_get_contents('php://input'), true);

//basic
$text = $efede["message"]["text"];
$photo = $efede["message"]["photo"];
$sana = $efede["message"]["date"];
$chat_id = $efede["message"]["chat"]["id"];

// chat
$cfname = $efede['message']['chat']['first_name'];
$cid = $efede["message"]["chat"]["id"];
$clast_name = $efede['message']['chat']['last_name'];
$turi = $efede["message"]["chat"]["type"];

//user info
$ufname = $efede['message']['from']['first_name'];
$uname = $efede['message']['from']['last_name'];
$ulogin = $efede['message']['from']['username'];
$uid = $efede['message']['from']['id'];
$user_id = $efede['message']['from']['id'];

//reply info
$sreply = $efede['message']['reply_to_message']['text'];


    // umumiy menu
    $menu = [["salom"],['Men haqimda']];

    if ($text == '/start') {

        $content = ['chat_id' => $chat_id, 'text' => "Assalomu alaykum $ufname $uname.", 'parse_mode' => 'markdown'];
        xabarYubor($content);
    }

    if ($text == 'salom') {

        $content = ['chat_id' => $chat_id, 'text' => "Sizga ham salom", 'parse_mode' => 'markdown'];
        xabarYubor($content);
    }

    if ($text == 'Men haqimda') {

        $content = ['chat_id' => $chat_id, 'text' => "Men @idFox tominidan yozildim", 'parse_mode' => 'markdown'];
        xabarYubor($content);
    }

