<?php

namespace Tests;

use Bowling\Game;
use PHPUnit\Framework\TestCase;

class GameTest extends TestCase{

    /**
     * @test 
     */
    public function TestShouldPass()
    {
        $this->assertEquals(1,1);
    }

    /**
     * @test 
     */
    public function TestContainElementWhenRoll()
    {
        $game = new Game();
        $game->roll(1);
        $this->assertCount(1, $game->aRolls); 
    }

    /**
     * @test 
     */
    public function TestWithoutStrikeOrSpare()
    {
        $game = new Game();
        $rolls = [2,3, 4,5, 2,1, 8,0, 0,0, 1,1, 0,9, 0,0, 0,1, 4,0];
        $expected = array_sum($rolls);

        for($i=0; $i<count($rolls); $i++){
            $game->roll( $rolls[$i] );
        }
        
        $this->assertEquals($expected, $game->score()); 
    }

    /**
     * @test 
     */
    public function TestWithStrike()
    {
        $game = new Game();
        $expected = (10 + 4 + 2) + 4 + 2 + (10 + 10 + 3) + (10 + 3 + 3) + 3 + 3;
        
        $game->roll(10);

        $game->roll(4);
        $game->roll(2);

        $game->roll(10);

        $game->roll(10);

        $game->roll(3);
        $game->roll(3);

        $this->assertEquals($expected, $game->score()); 
    }

    /**
     * @test 
     */
    public function TestWithSpare()
    {
        $game = new Game();
        $expected = (5 + 0) + (4 + 6 + 10) + (10 + 8 + 2) +  (8 + 2 + 10) + (10);
        
        $game->roll(5);
        $game->roll(0);

        $game->roll(4);
        $game->roll(6);

        $game->roll(10);

        $game->roll(8);
        $game->roll(2);

        $game->roll(10);

        $this->assertEquals($expected, $game->score()); 
    }

     /**
     * @test 
     */
    public function TestWithAllStrike()
    {
        $game = new Game();
        $expected = 300;
        
        for($i=0; $i<12; $i++){
            $game->roll(10);
        }
        
        $this->assertEquals($expected, $game->score()); 
    }

}