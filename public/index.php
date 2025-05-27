<?php

use LibraryApi\Microkernel\Container\Container;
use LibraryApi\Microkernel\Microkernel;
use LibraryApi\Microkernel\MicrokernelInterface;

require_once __DIR__ . '/../autoloader.php';

$container = Container::instance();
$container->bind(MicrokernelInterface::class, new Microkernel());

/** @var MicrokernelInterface $microkernel */
$microkernel = $container->make(MicrokernelInterface::class);
$microkernel->boot($container);

