<?php

require_once 'interpreter.php';
require_once 'processor.php';

$code = $argv[1];

$messages = interpret($code);
echo "Messages: " . implode(' ', $messages) . "\n";

$total = process($messages);
echo "Total: $total";
