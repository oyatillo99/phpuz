<?php
/*
Copyright 2016-2019 Daniil Gentili
(https://daniil.it)

Muammosiz ishlashi uchun eFeDe3 dan
https://t.me/ads_buy
*/
set_include_path(get_include_path().':'.realpath(dirname(__FILE__).'/MadelineProto/'));

define('MADELINE_BRANCH', '');
if (!file_exists('madeline.php')) {
    copy('https://phar.madelineproto.xyz/madeline.php', 'madeline.php');
}
include 'madeline.php';

class EventHandler extends \danog\MadelineProto\EventHandler
{
    public function onAny($update)
    {
        if (isset($update['message']['out']) && $update['message']['out']) {
            return;
        }
        if ($update['_'] === 'updateReadChannelOutbox') {
            return;
        }
        if (isset($update['message']['_']) && $update['message']['_'] === 'messageEmpty') {
            return;
        }

        if(isset($update['message'])){
            $msg = $update['message']['message'];
            $msg = $update['message']['message'];
            $text = $msg;
            $message_id = $update['message']['id'];

            if (isset($update['message']['reply_to_msg_id'])) {
                $reply_id = $update['message']['reply_to_msg_id'];
            }
            if (isset($update['message']['from_id'])) {
                $userID = $update['message']['from_id'];
                $user_id = $userID;
            }
            if (isset($update['message']['chat_id'])) {
                $chat_id = $update['message']['chat_id'];
            }

            if ($text == '/holat') {
                yield $this->messages->sendMessage(['peer' => $user_id, 'message' => "Men ish holatidaman", 'parse_mode' => 'markdown', 'reply_to_msg_id' => $message_id]);
            }
            if ($text == '/ping') {
                yield $this->messages->sendMessage(['peer' => $user_id, 'message' => "Men ish holatidaman", 'parse_mode' => 'markdown', 'reply_to_msg_id' => $message_id]);
            }
        }


    }
}

$settings =
  ['app_info' => [
        'api_id' => '281939',
        'api_hash' => '22244e99ad8b96b22dc8ee310af06b73'
    ],'logger' => ['logger_level' => 0],
];

$MadelineProto = new \danog\MadelineProto\API('ads_buy.madeline', $settings);
$MadelineProto->async(true);
$MadelineProto->loop(function () use ($MadelineProto) {
    yield $MadelineProto->start();
    yield $MadelineProto->setEventHandler('\EventHandler');
});
$MadelineProto->loop();
