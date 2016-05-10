<?php

namespace PhpSchool\SimpleMath\Exercise;

use PhpSchool\PhpWorkshop\Exercise\AbstractExercise;
use PhpSchool\PhpWorkshop\Exercise\CliExercise;
use PhpSchool\PhpWorkshop\Exercise\ExerciseInterface;
use PhpSchool\PhpWorkshop\Exercise\ExerciseType;
use PhpSchool\PhpWorkshop\ExerciseDispatcher;
use PhpSchool\SimpleMath\Check\Psr2Check;
use PhpSchool\SimpleMath\ExerciseCheck\Psr2ExerciseCheck;

class Mean extends AbstractExercise implements ExerciseInterface, CliExercise, Psr2ExerciseCheck
{

    /**
     * @return string
     */
    public function getName()
    {
        return 'Mean Average';
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return 'Simple Math';
    }

    /**
     * @return array
     */
    public function getArgs()
    {
        $numArgs = rand(0, 10);

        $args = [];
        for ($i = 0; $i < $numArgs; $i ++) {
            $args[] = rand(0, 100);
        }

        return $args;
    }

    /**
     * @return ExerciseType
     */
    public function getType()
    {
        return ExerciseType::CLI();
    }

    public function configure(ExerciseDispatcher $dispatcher)
    {
        $dispatcher->requireCheck(Psr2Check::class);
    }

    /**
     * @return string
     */
    public function getStandard()
    {
        return 'PSR2';
    }
}
