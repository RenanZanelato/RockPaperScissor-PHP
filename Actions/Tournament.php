<?php
namespace RockPaperScissor\Actions;

use RockPaperScissor\Entities\Player;
use RockPaperScissor\Actions\Rules;
use RockPaperScissor\Exceptions\AppLogicException;
use RockPaperScissor\Config\Players;

/**
 * Classe Tournament
 * 
 * @name Tournament
 * @author renan.zanelato <renan.zanelato@gazin.com.br>
 * @date   26/11/2019
 * @access public
 */
class Tournament
{

    /**
     *
     * @var Rules
     */
    private $Rules;
    private $round = 0;

    public function __construct(Rules $Rules)
    {
        $this->Rules = $Rules;
    }

    public function rpsTournamentWinner(array $ArrPlayers = [])
    {

        if (empty($ArrPlayers)) {
            throw new AppLogicException('No keys found for the Tournament');
        }

        foreach ($ArrPlayers as $key => $players) {
            if ($players[0] instanceof Player) {
                $playersPlayingNow[] = $this->rpsGameWinner($players);
            }
            if (is_array($players[0])) {
                $playersPlayingNow[] = $this->rpsTournamentWinner($players);
            }
        }

        return $this->rpsGameWinner($playersPlayingNow);
    }

    /**
     * 
     * @param Player $Player1
     * @param Player $Player2
     * @return Player
     */
    public function rpsGameWinner(array $players): Player
    {
        $this->round += 1;
        $this->Rules->checkTotalNumberOfPlayers($players);

        echo sprintf("<strong>Round %s</strong> <br>", $this->round, $players[0]->getName(), $players[1]->getName());
        echo sprintf("Player %s Move %s <strong>vs</strong> Player %s Move %s", $players[0]->getName(), $players[0]->getMove(), $players[1]->getName(), $players[1]->getMove());
        echo '<br>';
        $this->Rules->checkMovePlayer($players[0]);
        $this->Rules->checkMovePlayer($players[1]);
        $Winner = $this->Rules->checkMoveWinner($players[0], $players[1]);

        echo sprintf('Winner <strong>%s</strong>', $Winner->getName());
        echo '<br>';
        echo '<br>';
        return $Winner;
    }
}
