<?php

use App\PrimeFactors;

class PrimeFactorsTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     * @dataProvider generateInputsAndOutputs
     */
    public function itReturnsPrimeFactors($number,$results)
    {
        $this->assertSame($results,PrimeFactors::getPrimeNumbers($number));
    }

    public function generateInputsAndOutputs()
    {
        return [
          [1 ,[]],
          [2 ,[2]],
          [4 ,[2,2]],
          [5 ,[5]],
          [8 ,[2,2,2]],
          [12 ,[2,2,3]],
          [18 ,[2,3,3]],
          [40 ,[2,2,2,5]],
          [31 ,[31]],
          [100 ,[2,2,5,5]],
          [999 ,[3,3,3,37]],
        ];
    }
}