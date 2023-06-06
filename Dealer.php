<?php

class Dealer
{
    private $blackjack;
    private $deck;
    private $players;

    public function __construct($blackjack, $deck)
    {
        $this->deck = $deck;
        $this->blackjack = $blackjack;
        $this->players = array();
    }



    public function addPlayer($player)
    {
        $this->players[] = $player;
    }

    public function dealCards()
    {
        // Deal two cards to each player
        foreach ($this->players as $player) {
            $card1 = $this->deck->dealCard();
            $card2 = $this->deck->dealCard();

            $player->addCardToHand($card1);
            $player->addCardToHand($card2);
        }

        // Deal two cards to the dealer
        $card1 = $this->deck->dealCard();
        $card2 = $this->deck->dealCard();

        $this->blackjack->addCardToDealerHand($card1);
        $this->blackjack->addCardToDealerHand($card2);
    }

    public function getDealerHand()
    {
        return $this->blackjack->getDealerHand();
    }


    public function getPlayers()
    {
        return $this->players;
    }

    public function getDeck()
    {
        return $this->deck;
    }
    public function getBlackjack(): Blackjack
    {
        return $this->blackjack;
    }

    public function play()
    {
        // Show dealer's hand
        echo "Dealer's hand: ";
        $this->blackjack->showDealerHand();
    
        // Dealer hits until hand value is at least 17
        $dealerTotal = $this->blackjack->getDealerHandScore();
        while ($dealerTotal < 17) {
            $card = $this->deck->dealCard();
            $this->blackjack->addCardToDealerHand($card);
            $dealerTotal += $card->getValue();
            echo "Dealer pakt " . $card->getValue() . " " . $card->getSuit() . " (" . $dealerTotal . ")\n";
        }
    
        // Determine winner
        $dealerScore = $this->blackjack->getDealerHandScore();
        foreach ($this->players as $player) {
            $playerScore = $player->getHandScore();
            if ($this->blackjack->isBust($playerScore)) {
                echo $player->getName() . " busts over 21!\n";
            } elseif ($this->blackjack->isBlackjack($playerScore)) {
                echo $player->getName() . " heeft 21 blackjack!\n";
            } elseif ($this->blackjack->isBust($dealerScore) || $playerScore > $dealerScore) {
                echo $player->getName() . " gewonnen met een score van " . $playerScore . "!\n";
            } elseif ($dealerScore > $playerScore) {
                echo $player->getName() . " verloren met een score van " . $playerScore . ".\n";
            } else {
                echo $player->getName() . " gelijkspel met een score van " . $playerScore . ".\n";
            }
        }
        echo "Dealers totaal is " . $dealerTotal . "\n";
    }
}    
?>