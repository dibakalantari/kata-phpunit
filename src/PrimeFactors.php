<?php

namespace App;

class PrimeFactors
{
    public static function getPrimeNumbers(int $number)
    {
        if ($number == 1) {
            return [];
        }

        $factors = [];
        $divisor = 2;
        while ($divisor <= $number) {
            if($number%$divisor == 0) {
                $factors[] = $divisor;
                $number = $number/$divisor;
            } else{
                $divisor++;
            }
        }

        return $factors;
    }
}