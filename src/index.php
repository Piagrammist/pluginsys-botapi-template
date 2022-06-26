<?php

use Piagrammist\PluginSys\BotAPI\PluginManager;
use function Piagrammist\PluginSys\BotAPI\path;

ini_set('log_errors'     , '1');
ini_set('error_reporting', E_ALL & ~E_DEPRECATED);

require '../vendor/autoload.php';

const CACHE_LIMIT_TIME = 86400;
define('PLUGIN_DIR'  , path(__DIR__, 'plugins'));
define('PLUGIN_CACHE', path(__DIR__, 'plugins.cache'));


if (empty(\Piagrammist\PluginSys\BotAPITemplate\API_KEY)) {
    throw new \Exception("Invalid API key");
}

$update  = json_decode(file_get_contents('php://input'), true);
$manager = is_file(PLUGIN_CACHE)
    ? unserialize(file_get_contents(PLUGIN_CACHE))
    : new PluginManager(PLUGIN_DIR);

foreach ($update as $updateType => $data) {
    if (is_numeric($data)) {
        continue;
    }
    $manager->get(   'any'   )->executeAll($update, $manager);
    $manager->get($updateType)->executeAll( $data , $manager);
}

if (!is_file(PLUGIN_CACHE) || time() - filemtime(PLUGIN_CACHE) > CACHE_LIMIT_TIME) {
    file_put_contents(PLUGIN_CACHE, serialize($manager));
}
