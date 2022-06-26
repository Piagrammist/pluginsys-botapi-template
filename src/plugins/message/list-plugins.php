<?php

use Piagrammist\PluginSys\BotAPI\{
    Plugin,
    PluginStorage,
    PluginManager,
};
use function Piagrammist\PluginSys\BotAPITemplate\post;


return function (array $message, PluginManager $manager) {
    if ($message['text'] === '/plugins') {
        $lines = ["<b>Plugins</b>", null];
        foreach ($manager as $storage) {
            /** @var PluginStorage $storage */
            $lines []= sprintf('<i>%s</i> %s',
                (string) $storage, $storage->isActive() ? '✓' : '✘');
            foreach ($storage as $plugin) {
                /** @var Plugin $plugin */
                $lines []= sprintf('<code>%s</code> %s',
                    (string) $plugin, $plugin->isActive() ? '✓' : '✘');
            }
            $lines []= null;
        }
        post('sendMessage', [
            'chat_id'    => $message['chat']['id'],
            'text'       => implode("\n", $lines),
            'parse_mode' => 'HTML',
        ]);
    }
};
