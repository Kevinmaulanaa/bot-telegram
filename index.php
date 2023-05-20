<?php

use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use Botman\Botman\Drivers\TelegramDriver;
use BotMan\BotMan\Cache\SymfonyCache;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use BotMan\BotMan\Messages\Attachments\Image;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;

require_once __DIR__."/vendor/autoload.php";

$config = [
    //Your driver-specific configuration
    "telegram" => [
       "token" => "6033423596:AAHKQs-I9Vgfgd2v-XrHCvBMThvUgCq8P0I"
    ]
];

// Load the driver(s) you want to use
DriverManager::loadDriver(\BotMan\Drivers\Telegram\TelegramDriver::class);

$adapter = new FilesystemAdapter('', 0, __DIR__.'/cache');
$botman = BotManFactory::create($config, new SymfonyCache($adapter));

$botman->hears('/start', function (BotMan $bot) {
    $bot->typesAndWaits(0);
    $bot->reply('Selamat datang di bot Tricks Original By Kevin Maulana. Akun kamu bernama '.$bot->getUser()->getFirstName().' '.$bot->getUser()->getLastName());
});

// Create an instance
//$botman = BotManFactory::create($config);

// Give the bot something to listen for.
$botman->hears('Assalamualaikum', function (BotMan $bot) {

    $bot->typesAndWaits(2);

    $bot->reply('Waalaikumsalam '. $bot->getUser()->getFirstName());
});

// Give the bot something to listen for.
$botman->hears('gambar kucing', function (BotMan $bot) {
    $att = new Image("https://loremflickr.com/320/240?random=1");

    $message = OutgoingMessage::create("Ini kucing lucunya!")->withAttachment($att);

    $bot->reply($message);
});

// Give the bot something to listen for.
$botman->hears('gambar', function (BotMan $bot) {
    $att = new Image("https://picsum.photos/id/237/200/300");

    $message = OutgoingMessage::create("Ini gambarnya bro!")->withAttachment($att);

    $bot->reply($message);
});


$botman->fallback(function(BotMan $bot) {

    $bot->typesAndWaits(2);

    $bot->reply('Maaf, saya tidak memahami pesan anda');
});

// Start listening
$botman->listen();

?>
