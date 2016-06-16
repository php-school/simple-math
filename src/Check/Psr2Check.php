<?php

namespace PhpSchool\SimpleMath\Check;

use PhpSchool\PhpWorkshop\Check\SimpleCheckInterface;
use PhpSchool\PhpWorkshop\Exercise\ExerciseInterface;
use PhpSchool\PhpWorkshop\Exercise\ExerciseType;
use PhpSchool\PhpWorkshop\Result\Failure;
use PhpSchool\PhpWorkshop\Result\Success;
use PhpSchool\SimpleMath\ExerciseCheck\Psr2ExerciseCheck;
use PhpSchool\SimpleMath\Result\CodingStandardFailure;

class Psr2Check implements SimpleCheckInterface
{

    public function getName()
    {
        return 'PSR2 Code Check';
    }

    public function getExerciseInterface()
    {
        return Psr2ExerciseCheck::class;
    }

    public function canRun(ExerciseType $exerciseType)
    {
        return true;
    }

    public function check(ExerciseInterface $exercise, $fileName)
    {
        if (!$exercise instanceof Psr2ExerciseCheck) {
            throw new \InvalidArgumentException;
        }

        $standard = $exercise->getStandard();

        if (!in_array($standard, ['PSR1', 'PSR2', 'PEAR'])) {
            throw new \InvalidArgumentException('Standard is not supported');
        }

        $phpCsBinary = __DIR__ . '/../../vendor/bin/phpcs';
        $cmd = sprintf('%s %s --standard=%s --report=json', $phpCsBinary, $fileName, $standard);
        exec($cmd, $output, $exitCode);

        if ($exitCode === 0) {
            return new Success($this->getName());
        }

        $errors = json_decode($output[0], true)['files'][$fileName];
        $errors = array_map(function ($error) {
            return sprintf('Line %d, Column %d: %s', $error['line'], $error['column'], $error['message']);
        }, $errors['messages']);

        return CodingStandardFailure::fromCheckAndOutput($this, $standard, $errors);
    }

    public function getPosition()
    {
        return static::CHECK_BEFORE;
    }
}
