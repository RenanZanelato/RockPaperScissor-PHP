<?php
namespace RockPaperScissor\Actions;

use RockPaperScissor\Config\Chooses;
use RockPaperScissor\Config\Players;
use RockPaperScissor\Entities\Player;
use RockPaperScissor\Exceptions\NoSuchStrategyError;
use RockPaperScissor\Exceptions\WrongNumberOfPlayersError;

/**
 * Classe Rules
 * 
 * @name Rules
 * @author renan.zanelato <renan.zanelato@gazin.com.br>
 * @date   26/11/2019
 * @access public
 */
class Rules
{

    public function checkTotalNumberOfPlayers(array $players)
    {
        
        if (count($players) != Players::MAX_PLAYERS) {
            throw new WrongNumberOfPlayersError(sprintf('Invalid number off Players, Max Players: %s', Players::MAX_PLAYERS));
        }
        return true;
    }

    public function checkMovePlayer(Player $Player)
    {
        $validMovements = Chooses::getValidMove();
        if (!in_array($Player->getMove(), $validMovements)) {
            throw new NoSuchStrategyError(sprintf('Invalid Player Move,use only %s', implode(', ', $validMovements)), 400);
        }
        return true;
    }

    public function checkMoveWinner(Player $Player1, Player $Player2)
    {
        
        if (self::checkIfGameTied($Player1, $Player2)) {
            return $Player1;
        }

        if ($Player1->getMove() == Chooses::ROCK) {
            if ($Player2->getMove() == Chooses::PAPER) {
                return $Player2;
            }
        }
        if ($Player1->getMove() == Chooses::PAPER) {
            if ($Player2->getMove() == Chooses::SCISSORS) {
                return $Player2;
            }
        }
        if ($Player1->getMove() == Chooses::SCISSORS) {
            if ($Player2->getMove() == Chooses::ROCK) {
                return $Player2;
            }
        }
        return $Player1;
    }

    /**
     * 
     * @param Player $Player1
     * @param Player $Player2
     * @return bool
     */
    private static function checkIfGameTied(Player $Player1, Player $Player2): bool
    {
        return $Player1->getMove() === $Player2->getMove();
    }
}
