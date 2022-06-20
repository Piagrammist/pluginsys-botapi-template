<?php

use function Piagrammist\PluginSys\BotAPITemplate\post;


return function (array $message) {
    if ($message['text'] === '/reload') {
        unlink(PLUGIN_CACHE);
        post('sendMessage', [
            'chat_id' => $message['id'],
            'text'    => "Plugins were reloaded!",
        ]);
    }
};
