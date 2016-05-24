<?php

ini_set('display_errors', 1);
date_default_timezone_set('Europe/London');
switch (true) {
    case (file_exists(__DIR__ . '/../vendor/autoload.php')):
        // Installed standalone
        require __DIR__ . '/../vendor/autoload.php';
        break;
    case (file_exists(__DIR__ . '/../../../autoload.php')):
        // Installed as a Composer dependency
        require __DIR__ . '/../../../autoload.php';
        break;
    case (file_exists('vendor/autoload.php')):
        // As a Composer dependency, relative to CWD
        require 'vendor/autoload.php';
        break;
    default:
        throw new RuntimeException('Unable to locate Composer autoloader; please run "composer install".');
}

use PhpSchool\CouchDb\CouchDbCheck;
use PhpSchool\PhpWorkshop\Application;
use PhpSchool\SimpleMath\Exercise\CouchDbExercise;
use PhpSchool\SimpleMath\Exercise\Mean;

$app = new Application('Simple Math', __DIR__ . '/config.php');

$app->addExercise(Mean::class);
$app->addExercise(CouchDbExercise::class);
$app->addCheck(CouchDbCheck::class);

$art = <<<ART
  ∞ ÷ ∑ ×

 PHP SCHOOL
SIMPLE MATH
ART;

$app->setLogo($art);
$app->setFgColour('red');
$app->setBgColour('black');

return $app;
