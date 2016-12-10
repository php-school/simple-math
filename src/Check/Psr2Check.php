<?php

namespace PhpSchool\SimpleMath\Check;

use PhpSchool\PhpWorkshop\Check\SimpleCheckInterface;
use PhpSchool\PhpWorkshop\Exercise\ExerciseInterface;
use PhpSchool\PhpWorkshop\Exercise\ExerciseType;
use PhpSchool\PhpWorkshop\Input\Input;
use PhpSchool\PhpWorkshop\Result\Failure;
use PhpSchool\PhpWorkshop\Result\Success;

class Psr2Check implements SimpleCheckInterface
{

    public function getName()
    {
        return 'PSR2 Code Check';
    }

    public function getExerciseInterface()
    {
        return ExerciseInterface::class;
    }

    public function canRun(ExerciseType $exerciseType)
    {
        return in_array($exerciseType->getValue(), [ExerciseType::CGI, ExerciseType::CLI]);
    }

    public function check(ExerciseInterface $exercise, Input $input)
    {
        $phpCsBinary = __DIR__ . '/../../vendor/bin/phpcs';
        $cmd = sprintf('%s %s --standard=PSR2', $phpCsBinary, $input->getArgument('program'));
        exec($cmd, $output, $exitCode);

        if ($exitCode === 0) {
            return new Success($this->getName());
        }

        return new Failure($this->getName(), 'Coding style did not conform to PSR2!');
    }

    public function getPosition()
    {
        return static::CHECK_BEFORE;
    }
}
