<?php
$files = [
    __DIR__ . '/custom_autoload.php',
    __DIR__ . '/utilitarios/global_constants.php',
    __DIR__ . '/utilitarios/global_functions.php',
];

foreach ($files as $file) {
    require_once $file;
}
