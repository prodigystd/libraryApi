<?php

use LibraryApi\Microkernel\Microkernel;

require __DIR__ . '/autoloader.php';

$microkernel = new Microkernel();
$microkernel->boot();

