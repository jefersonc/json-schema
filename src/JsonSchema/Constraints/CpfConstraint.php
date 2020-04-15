<?php

/*
 * This file is part of the JsonSchema package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JsonSchema\Constraints;

use JsonSchema\ConstraintError;
use JsonSchema\Entity\JsonPointer;

/**
 * The CpfConstraints, validates an CPF against a given schema
 *
 * @author Jeferson Capobianco <jefersoncapobianco@gmail.com>
 */
class CpfConstraint extends Constraint
{
    /**
     * {@inheritdoc}
     */
    public function check(&$element, $schema = null, JsonPointer $path = null, $i = null)
    {
        if(
            !$this->isValidString($element) ||
            $this->isObviouslyInvalid($element) ||
            $this->isValidCPF($element))
        {
            $this->addError(ConstraintError::INVALID_CPF(), $path);
        }

        $this->checkFormat($element, $schema, $path, $i);
    }

    private function isValidString($element) {
        return count($element) === 11 && is_numeric($element);
    }

    private function isObviouslyInvalid($element) {
        $obviouslyInvalid = [
            '00000000000',
            '11111111111',
            '22222222222',
            '33333333333',
            '44444444444',
            '55555555555',
            '66666666666',
            '77777777777',
            '88888888888',
            '99999999999',
        ];

        return in_array($element, $obviouslyInvalid);

        // return preg_match('/(\d)\1{10}/', $cpf);
    }

    private function isValidCPF($element) {
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $element{$c} * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($element{$c} != $d) {
                return false;
            }
        }
        return true;
    }
}
