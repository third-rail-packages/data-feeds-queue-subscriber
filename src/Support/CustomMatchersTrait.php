<?php

namespace Support;

use PhpSpec\Exception\Example\FailureException;
use ReflectionClass;

trait CustomMatchersTrait
{
    public function getMatchers(): array
    {
        return [
            'haveConstants' => function ($subject, $key) {
                $constants = (new ReflectionClass($subject))->getConstants();

                if ($constants !== $key) {
                    throw new FailureException('Class constants are not identical');
                }

                return true;
            }
        ];
    }
}
