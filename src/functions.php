<?php declare(strict_types=1);

namespace Piagrammist\PluginSys\BotAPITemplate;


function post(string $method, array $params=[]): array {
    $ch = \curl_init();
    \curl_setopt_array($ch, [
        \CURLOPT_URL            => 'https://api.telegram.org/bot' .API_KEY. "/$method",
        \CURLOPT_POST           => true,
        \CURLOPT_POSTFIELDS     => $params,
        \CURLOPT_RETURNTRANSFER => true,

        \CURLOPT_PROXY    => '127.0.0.1:10808',
        CURLOPT_PROXYTYPE => \CURLPROXY_SOCKS5,
    ]);
    $result = \curl_exec($ch);

    if (\curl_errno($ch)) {
        throw new \RuntimeException(
            "cURL Error(".\curl_errno($ch).'): ' . \curl_error($ch)
        );
    }
    \curl_close($ch);

    $result = \json_decode($result, true, flags: \JSON_THROW_ON_ERROR);
    if (!$result['ok']) {
        throw new \RuntimeException("Telegram Error: {$result['description']}");
    }

    return $result;
}
