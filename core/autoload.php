<?php

require dirname(__FILE__) . '/functions.php';
spl_autoload_register(function ($name) {
    require dirname(__FILE__) . '/'.$name . '.php';
});
