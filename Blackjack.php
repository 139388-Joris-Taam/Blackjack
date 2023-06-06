<?php

class Blackjack
{
    private $dealerHand;
    private $playerHand;

    public function __construct()
    {
        $this->dealerHand = array();
        $this->playerHand = array();
    }

    public function addCardToDealerHand($card)
    {
        $this->dealerHand[] = $card;
    }

    public function addCardToPlayerHand($card)
    {
        $this->playerHand[] = $card;
    }

    public function getDealerHand()
    {
        return $this->dealerHand;
    }

    public function getPlayerHand()
    {
        return $this->playerHand;
    }

    public function getDealerHandScore()
    {
        $score = 0;
        $numAces = 0;
        foreach ($this->dealerHand as $card) {
            $value = $card->getValue();
            if ($value === "A") {
                $numAces++;
                $score += 11;
            } elseif ($value === "K" || $value === "Q" || $value === "J") {
                $score += 10;
            } else {
                $score += $value;
            }
        }
        while ($numAces > 0 && $score > 21) {
            $score -= 10;
            $numAces--;
        }
        return $score;
    }

    public function getPlayerHandScore()
    {
        $score = 0;
        $numAces = 0;
        foreach ($this->playerHand as $card) {
            $value = $card->getValue();
            if ($value === "A") {
                $numAces++;
                $score += 11;
            } elseif ($value === "K" || $value === "Q" || $value === "J") {
                $score += 10;
            } else {
                $score += $value;
            }
        }
        while ($numAces > 0 && $score > 21) {
            $score -= 10;
            $numAces--;
        }
        return $score;
    }

    public function isBust($score)
    {
        return $score > 21;
    }

    public function isBlackjack($score)
    {
        return $score === 21;
    }

    public function showDealerHand()
    {
        foreach ($this->dealerHand as $card) {
            echo $card->getValue() . " " . $card->getSuit() . " ";
        }
        echo "\n";
    }
}
?>
