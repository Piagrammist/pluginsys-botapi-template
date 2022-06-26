<?php

use Piagrammist\PluginSys\BotAPI\PluginManager;
use function Piagrammist\PluginSys\BotAPITemplate\post;


return function (array $update, PluginManager $manager) {
    post('sendMessage', [
        'chat_id' => $update['message']['chat']['id'],
        'message' => "Hello, world!",
    ]);
};
