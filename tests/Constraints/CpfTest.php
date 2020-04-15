<?php

/*
 * This file is part of the JsonSchema package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JsonSchema\Tests\Constraints;

class CpfTest extends BaseTestCase
{
    protected $validateSchema = true;

    public function getInvalidTests()
    {
        return array(
            array(
                '{
                  "integer": 11111111111
                }',
                '{
                  "type":"object",
                  "properties":{
                    "integer":{"type":"cpf"}
                  }
                }'
            ),
            array(
                '{"integer": 999.999.999-99}',
                '{
                    "type": "object",
                    "properties": {
                        "integer": {"type": "cpf"}
                    }
                }'
            ),
            array(
                '{"integer": true}',
                '{
                    "type": "object",
                    "properties": {
                        "integer": {"type": "cpf"}
                    }
                }'
            ),
            array(
                '{"number": "x"}',
                '{
                    "type": "object",
                    "properties": {
                        "number": {"type": "cpf"}
                    }
                }'
            )
        );
    }

    public function getValidTests()
    {
        return array(
            array(
                '{
                  "integer": 52111351059
                }',
                '{
                  "type":"object",
                  "properties":{
                    "integer":{"type":"cpf"}
                  }
                }'
            )
        );
    }
}
