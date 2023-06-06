<?php

require_once 'Blackjack.php';
require_once 'Card.php';
require_once 'Dealer.php';
require_once 'Deck.php';
require_once 'Player.php';

$dealer = new Dealer(new Blackjack('Dealer'), new Deck());
$dealer->addPlayer(new Player('Bruno'));
$dealer->addPlayer(new Player('Robin'));

// Deal initial hands to players and the dealer
$dealer->dealCards();

// Show dealer's first card
echo "Dealer  laat zien: " . $dealer->getDealerHand()[0]->getValue() . " " . $dealer->getDealerHand()[0]->getSuit() . "\n";

// Play each player's turn
foreach ($dealer->getPlayers() as $player) {
    echo $player->getName() . "'s turn. Hand: ";
    $player->showHand();
    while ($player->getHandScore() < 21) {
        $input = readline("nog een kaart d (draw) of s (stop) je? ");
        if ($input === "d") {
            $card = $dealer->getDeck()->dealCard();
            $player->addCardToHand($card);
            echo $player->getName() . " drew " . $card->getValue() . " " . $card->getSuit() . "\n";
            echo $player->getName() . "'s hand: ";
            $player->showHand();
        } else {
            echo $player->getName() . " stop.\n";
            break;
        }
    }
}
// Dealer's turn
$dealer->play();
