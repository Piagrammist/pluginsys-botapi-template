<?php

use function Piagrammist\PluginSys\BotAPITemplate\post;


return function (array $callback) {
    if ($callback['data'] === 'doSomething') {
        post('editMessageText', [
            'chat_id'    => $callback['message']['chat']['id'],
            'message_id' => $callback['message']['message_id'],
            'text'       => "DONE!",
        ]);
    }
};
