<?php
require_once __DIR__."/vendor/autoload.php";

use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\BotMan\Messages\Attachments\Image;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;

$config = [];

DriverManager::loadDriver(\BotMan\Drivers\Web\WebDriver::class);

$botman = BotManFactory::create($config);

$botman->hears('assalamualaikum', function (BotMan $bot) {
  $bot->reply('waalaikumsalam');
});

$botman->hears('logo', function (BotMan $bot) {
    $attachment = new Image('https://botman.io/img/logo.png');
    $message = OutgoingMessage::create('Ini logonya')->withAttachment($attachment);
    $bot->reply($message);
});

$botman->hears('saya {name}', function ($bot, $name) {
    $bot->reply('nama anda adalah '.$name);
});  

$botman->fallback(function(BotMan $bot) {
    $bot->reply('Maaf, saya tidak memahami pesan anda');
});

$botman->listen();
?>