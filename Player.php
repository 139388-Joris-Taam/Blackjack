<?php

class Player
{
    private $name;
    private $hand;

    public function __construct($name)
    {
        $this->name = $name;
        $this->hand = array();
    }

    public function getName()
    {
        return $this->name;
    }

    public function addCardToHand($card)
    {
        $this->hand[] = $card;
    }

    public function getHand()
    {
        return $this->hand;
    }

    public function getHandScore()
    {
        $score = 0;
        $num_aces = 0;
        foreach ($this->hand as $card) {
            $score += $card->getScore();
            if ($card->getValue() === 1) {
                $num_aces++;
            }
        }
        while ($score > 21 && $num_aces > 0) {
            $score -= 10;
            $num_aces--;
        }
        return $score;
    }

    public function showHand()
    {
        foreach ($this->hand as $card) {
            echo $card->getValue() . " " . $card->getSuit() . " ";
        }
        echo "(" . $this->getHandScore() . ")\n";
    }
}
