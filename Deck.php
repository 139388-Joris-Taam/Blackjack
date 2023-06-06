<?php

class Deck
{
    private $cards;

    public function __construct()
    {
        $this->cards = array();
        $suits = ['♠', '♣', '♥', '♦'];
        foreach ($suits as $suit) {
            for ($i = 1; $i <= 13; $i++) {
                $card = new Card($suit, $i);
                $this->cards[] = $card;
            }
        }
        shuffle($this->cards);
    }

    public function dealCard()
    {
        return array_pop($this->cards);
    }


    public function getCards()
    {
        return $this->cards;
    }
}
