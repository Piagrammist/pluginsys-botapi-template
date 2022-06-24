<?php

use Piagrammist\PluginSys\BotAPI\{Plugin, PluginStorage};
use function Piagrammist\PluginSys\BotAPITemplate\post;


return function (array $message) {
    if ($message['text'] === '/plugins') {
        $params = [
            'chat_id'    => $message['chat']['id'],
            'parse_mode' => 'Markdown'
        ];
        if (isset($manager)) {
            $lines = ["*Plugins*", null, null];
            $groups = $plugins = 1;
            foreach ($manager as $storage) {
                /** @var PluginStorage $storage */
                $lines []= sprintf('%s. _%s (%s)_',
                    $groups, (string) $storage, $storage->isActive() ? '✓' : '✘');
                foreach ($storage as $plugin) {
                    /** @var Plugin $plugin */
                    $lines []= sprintf('%s. `%s (%s)`',
                        $plugins, (string) $plugin, $plugin->isActive() ? '✓' : '✘');
                    $plugins++;
                }
                $lines []= null;
                $plugins = 1;
                $groups++;
            }
            $params['text'] = implode("\n", $lines);
        } else {
            $params['text'] = "*Error*\n`PluginManager not found!`";
        }
        post('sendMessage', $params);
    }
};
