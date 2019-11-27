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
    private $mouvement = [];

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

        $this->Rules->checkMovePlayer($players[0]);
        $this->Rules->checkMovePlayer($players[1]);
        $Winner = $this->Rules->checkMoveWinner($players[0], $players[1]);

        
        $this->addMouvement(sprintf("<strong>Round %s </strong>", $this->round));
        $this->addMouvement(sprintf("Player <strong>%s</strong> Move %s <strong>vs</strong> Player <strong>%s</strong> Move %s", $players[0]->getName(), $players[0]->getMove(), $players[1]->getName(), $players[1]->getMove()));
        $this->addMouvement(sprintf('Winner <strong>%s</strong>', $Winner->getName()));
        $this->addMouvement('');

        return $Winner;
    }

    public function getMouvement($to_string = false)
    {
        return $to_string ? implode('<br>', $this->mouvement) : $this->mouvement;
    }

    public function addMouvement($mouvement)
    {
        $this->mouvement[] = $mouvement;
        return $this;
    }
}
