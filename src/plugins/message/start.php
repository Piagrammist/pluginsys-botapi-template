<?php

use function Piagrammist\PluginSys\BotAPITemplate\post;


return function (array $message, $_) {
    if ($message['text'] === '/start') {
        post('sendMessage', [
            'chat_id'      => $message['chat']['id'],
            'text'         => "Hello, World!",
            'reply_markup' => json_encode([
                'inline_keyboard' => [
                    [['text'          => "Click Me!",
                      'callback_data' => 'doSomething']],
                ],
            ]),
        ]);
    }
};
