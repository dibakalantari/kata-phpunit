<?php

use App\TennisGame;

class TennisTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     * @return void
     * @dataProvider scores
     */
    public function it_scores_a_tennis_match($playerOneScore, $playerTwoScore,$result)
    {
        $game = new TennisGame();

        for ($i=0;$i<$playerOneScore;$i++) {
            $game->pointToPlayerOne();
        }

        for ($i=0;$i<$playerTwoScore;$i++) {
            $game->pointToPlayerTwo();
        }

        $this->assertEquals($result,$game->score());
    }

    public function scores()
    {
        return [
          [0,0,'love-love'],
          [1,0,'fifteen-love'],
          [1,1,'fifteen-fifteen'],
          [2,0,'thirty-love'],
          [3,0,'forty-love'],
          [4,0,'Winner: Player 1'],
          [4,2,'Winner: Player 1'],
          [0,4,'Winner: Player 2'],
          [3,3,'deuce'],
          [2,2,'thirty-thirty'],
          [4,3,'Advantage: Player 1'],
          [4,5,'Advantage: Player 2'],
        ];
    }
}