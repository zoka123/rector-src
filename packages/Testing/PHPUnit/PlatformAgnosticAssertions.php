<?php

namespace Rector\Testing\PHPUnit;

/**
 * Relaxes phpunit assertions to be forgiving about platform issues, like directory-separators or newlines.
 */
trait PlatformAgnosticAssertions {
    /**
     * Asserts that two variables have the same type and value.
     * Used on objects, it asserts that two variables reference
     * the same object.
     *
     * @psalm-template ExpectedType
     * @psalm-param ExpectedType $expected
     * @psalm-assert =ExpectedType $actual
     */
    public static function assertSame($expected, $actual, string $message = ''): void
    {
        $expected = str_replace("\r\n", "\n", $expected);
        $actual = str_replace("\r\n", "\n", $actual);

        $expected = str_replace(DIRECTORY_SEPARATOR, "/", $expected);
        $actual = str_replace(DIRECTORY_SEPARATOR, "/", $actual);

        parent::assertSame($expected, $actual, $message);
    }
}