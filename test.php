<?php

if (
    !class_exists('PHPUnit_Framework_TestCase')
    && class_exists('\PHPUnit\Framework\TestCase')
) {
    class_alias(
        '\PHPUnit\Framework\TestCase',
        'PHPUnit_Framework_TestCase'
    );
}

if (class_exists('PHPUnit_Framework_TestCase')) {
    class TestArrayNested extends PHPUnit_Framework_TestCase
    {
        /**
         * @covers array_nested
         * @dataProvider provider_nested
         */
        function test_nested($args, $reference, $expected)
        {
            $array = array_shift($args);
            array_splice($args, 0, 0, array(&$array));
            $result = call_user_func_array("array_nested", $args);
            $this->assertSame($reference, $array);
            $this->assertSame($expected, $result);
        }

        function provider_nested()
        {
            return array(
                "get_int" => array(
                    "args" => array(
                        "array" => array(
                            array("123", "test"),
                            array()
                        ),
                        "path" => array(0)
                    ),
                    "reference" => array(
                        array("123", "test"),
                        array()
                    ),
                    "result" => array("123", "test")
                ),

                "get_assoc" => array(
                    "args" => array(
                        "array" => array(
                            "42e" => array(),
                            "123c" => array(
                                "123",
                                "test",
                                "a" => array(42)
                            )
                        ),
                        "path" => array("123c", "a")
                    ),
                    "reference" => array(
                        "42e" => array(),
                        "123c" => array(
                            "123",
                            "test",
                            "a" => array(42)
                        )
                    ),
                    "result" => array(42)
                ),

                "set_int" => array(
                    "args" => array(
                        "array" => array(),
                        "path" => array(0, 1, 2, 3, 4, 5),
                        "value" => 12345
                    ),
                    "reference" => array(
                        array(
                            1 => array(
                                2 => array(
                                    3 => array(
                                        4 => array(
                                            5 => 12345
                                        )
                                    )
                                )
                            )
                        )
                    ),
                    "result" => null
                ),

                "set_assoc" => array(
                    "args" => array(
                        "array" => array(
                            "key1" => "value1",
                            "key2" => "value2"
                        ),
                        "path" => array("key1"),
                        "value" => "value12"
                    ),
                    "reference" => array(
                        "key1" => "value12",
                        "key2" => "value2"
                    ),
                    "result" => "value1"
                )
            );
        }
    }
}
