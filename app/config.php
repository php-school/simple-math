<?php

use function DI\factory;
use function DI\object;
use Interop\Container\ContainerInterface;
use PhpSchool\SimpleMath\Exercise\GetExercise;
use PhpSchool\SimpleMath\Exercise\Mean;
use PhpSchool\SimpleMath\Exercise\PostExercise;
use PhpSchool\SimpleMath\MyFileSystem;

return [
    //Define your exercise factories here
    Mean::class => factory(function (ContainerInterface $c) {
        return new Mean($c->get(\Symfony\Component\Filesystem\Filesystem::class));
    }),
];
