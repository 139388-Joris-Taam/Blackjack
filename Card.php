<?php

class Card
{
    private $suit;
    private $value;

    public function __construct($suit, $value)
    {
        $this->suit = $suit;
        $this->value = $value;
    }

    public function getSuit()
    {
        return $this->suit;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function getScore()
    {
        if ($this->value >= 10) {
            return 10;
        } elseif ($this->value === 1) {
            return 11;
        } else {
            return $this->value;
        }
    }
}
