<?php

namespace Phossa\Orm\Utility;

/**
 * Utility test case.
 */
class UtilityTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @covers Phossa\Orm\Utility\Utility::convertCase()
     */
    public function testConvertCase()
    {
        // to camelCase
        $this->assertEquals(
            'stringToTest',
            Utility::convertCase('StringToTest', Utility::CASE_CAMEL)
        );

        // to snake_case
        $this->assertEquals(
            'string_to_test',
            Utility::convertCase('stringToTest', Utility::CASE_SNAKE)
        );
    }
}

