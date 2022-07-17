<?php

namespace App;

class BowlingGame
{
    /**
     * All roles for the game
     *
     * @var array
     */
    public array $rolls = [];
    /*
     * The number of frames in a game
     */
    public const FRAME_COUNT_PER_GAME = 10;

    public function roll($roll)
    {
        $this->rolls[] = $roll;
    }

    public function score()
    {
        $score = 0;
        $roll = 0;

        foreach (range(1, self::FRAME_COUNT_PER_GAME) as $frame) {
            if ($this->isStrike($roll)) {
                $score += $this->pinCount($roll) + $this->strikeBonus($roll);

                $roll += 1;

                continue;
            }

            $score += $this->defaultFrameScore($roll);

            if ($this->isSpare($roll)) {
                $score += $this->spareBonus($roll);
            }

            $roll += 2;
        }

        return $score;
    }

    /**
     * @param int $roll
     * @return bool
     */
    private function isStrike(int $roll): bool
    {
        return $this->pinCount($roll) == 10;
    }

    /**
     * @param int $roll
     * @return bool
     */
    private function isSpare(int $roll): bool
    {
        return $this->defaultFrameScore($roll) == 10;
    }

    /**
     * @param int $roll
     * @return mixed
     */
    private function defaultFrameScore(int $roll): mixed
    {
        return $this->pinCount($roll) + $this->pinCount($roll + 1);
    }

    private function strikeBonus(int $roll) {
       return $this->pinCount($roll + 1) + $this->pinCount($roll + 2);
    }

    /**
     * @param int $roll
     * @return mixed
     */
    private function spareBonus(int $roll): mixed
    {
        return $this->pinCount($roll + 2);
    }

    protected function pinCount(int $roll): int
    {
        return $this->rolls[$roll];
    }
}