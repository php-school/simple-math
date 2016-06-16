<?php

namespace PhpSchool\SimpleMath\ResultRenderer;

use PhpSchool\PhpWorkshop\ResultRenderer\ResultRendererInterface;
use PhpSchool\PhpWorkshop\ResultRenderer\ResultsRenderer;
use PhpSchool\SimpleMath\Result\CodingStandardFailure;

/**
 * Class CodingStandardFailureRenderer
 * @author Aydin Hassan <aydin@hotmail.co.uk>
 */
class CodingStandardFailureRenderer implements ResultRendererInterface
{
    /**
     * @var CodingStandardFailure
     */
    private $failure;

    /**
     * @param CodingStandardFailure $failure
     */
    public function __construct(CodingStandardFailure $failure)
    {
        $this->failure = $failure;
    }

    /**
     * @param ResultsRenderer $renderer
     * @return string
     */
    public function render(ResultsRenderer $renderer)
    {
        $header = sprintf(
            'Coding Standards found violations using the standard: "%s"',
            $this->failure->getCodingStandard()
        );
        $output = [
            sprintf('  %s', $renderer->style($header, ['bold', 'underline', 'yellow'])),
        ];

        foreach ($this->failure->getErrors() as $error) {
            $output[] = '   * ' . $renderer->style($error, 'red');
        }
        $output[] = '';

        return implode("\n", $output);
    }
}
