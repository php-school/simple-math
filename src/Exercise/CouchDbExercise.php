<?php

namespace PhpSchool\SimpleMath\Exercise;

use Doctrine\CouchDB\CouchDBClient;
use PhpSchool\CouchDb\CouchDbCheck;
use PhpSchool\CouchDb\CouchDbExerciseCheck;
use PhpSchool\PhpWorkshop\Exercise\AbstractExercise;
use PhpSchool\PhpWorkshop\Exercise\CliExercise;
use PhpSchool\PhpWorkshop\Exercise\ExerciseInterface;
use PhpSchool\PhpWorkshop\Exercise\ExerciseType;
use PhpSchool\PhpWorkshop\ExerciseDispatcher;

/**
 * Class CouchDbExercise
 * @package PhpSchool\SimpleMath\Exercise
 * @author Aydin Hassan <aydin@hotmail.co.uk>
 */
class CouchDbExercise extends AbstractExercise implements ExerciseInterface, CliExercise, CouchDbExerciseCheck
{
    /**
     * @var string
     */
    private $docId;

    /**
     * @var int
     */
    private $total;

    /**
     * @return string
     */
    public function getName()
    {
        return 'Couch DB Exercise';
    }

     /**
     * @return string
     */
    public function getDescription()
    {
        return 'Intro to Couch DB';
    }

    /**
     * @return string[]
     */
    public function getArgs()
    {
        return [$this->docId];
    }

    /**
     * @return ExerciseType
     */
    public function getType()
    {
        return ExerciseType::CLI();
    }

    /**
     * @param ExerciseDispatcher $dispatcher
     */
    public function configure(ExerciseDispatcher $dispatcher)
    {
        $dispatcher->requireCheck(CouchDbCheck::class);
    }

    /**
     * @param CouchDBClient $couchDbClient
     * @return void
     */
    public function seed(CouchDBClient $couchDbClient)
    {
        $numArgs = rand(4, 20);
        $args = [];
        for ($i = 0; $i < $numArgs; $i ++) {
            $args[] = rand(1, 100);
        }

        list($id) = $couchDbClient->postDocument(['numbers' => $args]);

        $this->docId = $id;
        $this->total = array_sum($args);
    }

    /**
     * @param CouchDBClient $couchDbClient
     * @return bool
     */
    public function verify(CouchDBClient $couchDbClient)
    {
        $total = $couchDbClient->findDocument($this->docId);

        return isset($total->body['total']) && $total->body['total'] == $this->total;
    }
}
