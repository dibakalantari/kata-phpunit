<?php

namespace App;

class TennisGame
{
    /**
     * NOTICEEEEEE
     * This class doesnt have the exact implementation that Jeffrey did, his was a little different and kinda better
     */
    protected $score;

    protected $playerOnePoint = 0;
    protected $playerTwoPoint = 0;

    public $scoreTerms = [
        0 => 'love',
        1 => 'fifteen',
        2 => 'thirty',
        3 => 'forty',
    ];

    public function score()
    {
        if ($this->isDeuce()) {
            return 'deuce';
        }

        if ($this->hasWinner()) {
            return "Winner: Player ".$this->leader();
        }

        if ($this->checkForAdvantage()) {
            return "Advantage: Player ".$this->leader();
        }

        return sprintf(
            "%s-%s",
            $this->scoreTerms[$this->playerOnePoint],
            $this->scoreTerms[$this->playerTwoPoint]
        );
    }

    public function pointToPlayerOne()
    {
        $this->playerOnePoint++;
    }

    public function pointToPlayerTwo()
    {
        $this->playerTwoPoint++;
    }

    private function leader()
    {
        if ($this->playerOnePoint > $this->playerTwoPoint) {
            return 1;
        }

        if ($this->playerTwoPoint > $this->playerOnePoint) {
            return 2;
        }
    }

    private function isDeuce()
    {
        return $this->playerOnePoint == $this->playerTwoPoint && $this->playerOnePoint >= 3;
    }

    public function hasWinner()
    {
        if ($this->playerOnePoint >= 4 && $this->playerOnePoint - $this->playerTwoPoint >= 2) {
            return true;
        }

        if ($this->playerTwoPoint >= 4 && $this->playerTwoPoint - $this->playerOnePoint >= 2) {
            return true;
        }

        return false;
    }

    private function checkForAdvantage()
    {
        $canWon = $this->playerOnePoint >= 3 && $this->playerTwoPoint >= 3;

        if ($canWon && $this->playerOnePoint - $this->playerTwoPoint >= 1) {
            return true;
        }

        if ($canWon && $this->playerTwoPoint - $this->playerOnePoint >= 1) {
            return true;
        }

        return false;
    }
}