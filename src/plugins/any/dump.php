<?php

return function (array $update, $_) {
    \file_put_contents(__DIR__.'/../../update.json', json_encode($update, 448));
};
