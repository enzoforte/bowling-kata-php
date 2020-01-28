<?php

namespace Bowling;

class Game {

    public $aRolls;
    public $frame = 0;

    
    public function __construct()
    {
        $this->aRolls = array();   
    }

    /**
     * is called each time the player rolls a ball.  
     * @param pin The argument is the number of pins knocked down.
     */
    public function roll(int $pins)
    {
        array_push($this->aRolls, $pins);
        
        if($this->frame === 10){
            //last frame 
            return;
        }

        if(($this->frame % 2) === 0){
            $this->frame++;
        
        }elseif($pins === 10){
            $this->frame++;
        }
    }

    /**
     * is called only at the very end of the game.
     * @return int total score for that game.
     */
    public function score()
    {
        $score = 0;
        //print_r($this->aRolls);
        foreach($this->aRolls as $key => $roll){

             //is a last frame
            if($this->frame === 10){
               
            }

            //is a strike 
            if($roll === 10 && $this->frame !== 10){
                if(isset($this->aRolls[$key + 1]) && isset($this->aRolls[$key + 2])){
                    $score += $this->aRolls[$key + 1]; // add next frame score
                    $score += $this->aRolls[$key + 2];
                }
                $this->frame++;
            }

            //is a spare
            if(isset($this->aRolls[$key + 1])){
                if( ($this->aRolls[$key] + $this->aRolls[$key + 1]) === 10){
                    $score += $this->aRolls[$key + 2]; // add next frame score
                }   
            }

            $score += $roll;

            if(($this->frame % 2) === 0){
                $this->frame++;
            }
            
        }
        return $score;
    }
}