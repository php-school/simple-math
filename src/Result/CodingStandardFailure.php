<?php

namespace PhpSchool\SimpleMath\Result;

use PhpSchool\PhpWorkshop\Check\CheckInterface;
use PhpSchool\PhpWorkshop\Result\FailureInterface;

/**
 * Class CodingStandardFailure
 * @author Aydin Hassan <aydin@hotmail.co.uk>
 */
class CodingStandardFailure implements FailureInterface
{

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $codingStandard;

    /**
     * @var array
     */
    private $errors;

    /**
     * @param $name
     * @param $codingStandard
     * @param array $errors
     */
    public function __construct($name, $codingStandard, array $errors)
    {
        $this->name             = $name;
        $this->codingStandard   = $codingStandard;
        $this->errors           = $errors;
    }

    /**
     * @param CheckInterface $check
     * @param $codingStandard
     * @param array $errors
     * @return static
     */
    public static function fromCheckAndOutput(CheckInterface $check, $codingStandard, array $errors)
    {
        return new static($check->getName(), $codingStandard, $errors);
    }

    /**
     * @return string
     */
    public function getCheckName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getCodingStandard()
    {
        return $this->codingStandard;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }
}
