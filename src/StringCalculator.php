<?php

namespace App;

use http\Exception;
use function PHPUnit\Framework\stringStartsWith;

class StringCalculator
{
    const MAX_NUMBER_ALLOWED = 1000;

    protected $delimeter = ",|\n";

    public function add(string $numbers)
    {
        if(!$numbers) {
            return 0;
        }

        $numbers = $this->parseString($numbers);

        $numbers = $this
            ->disallowNegatives($numbers)
            ->ignoreGreaterThan1000($numbers);

        return array_sum($numbers);
    }

    /**
     * @param array|bool $numbers
     * @return void
     * @throws \Exception
     */
    public function disallowNegatives(array|bool $numbers): StringCalculator
    {
        foreach ($numbers as $number) {
            if ($number < 0) {
                throw new \Exception("Negative numbers are disallowed");
            }
        }

        return $this;
    }

    /**
     * @param array|bool $numbers
     * @return array|bool
     */
    public function ignoreGreaterThan1000(array|bool $numbers): array|bool
    {
        return array_filter($numbers, fn($number) => $number <= self::MAX_NUMBER_ALLOWED);
    }

    public function parseString($numbers)
    {
        $customDelimiter = "\/\/(.)\n";

        if (preg_match("/$customDelimiter/", $numbers, $matches)) {
            $this->delimeter = $matches[1];

            $numbers = str_replace($matches[0],'',$numbers);
        }

        $numbers = preg_split("/$this->delimeter/", $numbers);

        return $numbers;
    }
}