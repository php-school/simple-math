<?php

use function DI\factory;
use function DI\object;
use Interop\Container\ContainerInterface;
use PhpSchool\SimpleMath\Check\Psr2Check;
use PhpSchool\SimpleMath\Exercise\Mean;
use Symfony\Component\Filesystem\Filesystem;

return [
    //Define your exercise factories here
    Mean::class => factory(function (ContainerInterface $c) {
        return new Mean($c->get(Filesystem::class));
    }),

    Psr2Check::class => object(),
];
