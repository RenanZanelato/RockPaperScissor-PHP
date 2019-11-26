<?php
require 'autoload.php';

use RockPaperScissor\Actions\Rules;
use RockPaperScissor\Actions\Tournament;
use RockPaperScissor\Config\Chooses;
use RockPaperScissor\Config\Players;
use RockPaperScissor\Entities\Player as PlayerEntity;
use RockPaperScissor\Exceptions\NoSuchStrategyError;
use RockPaperScissor\Exceptions\WrongNumberOfPlayersError;
use RockPaperScissor\Entities\Player;

$ArrPlayers = [
        [
            [["Armando", "P"], ["Dave", "S"]],
            [["Richard", "R"], ["Michael", "S"]],
    ],
        [
            [["Allen", "S"], ["Omer", "P"]],
            [["David E.", "R"], ["Richard X.", "P"]]
    ]
];

function setKeysTournament($ArrPlayers)
{
    foreach ($ArrPlayers as $keyPlayers) {
        if (isset($keyPlayers[1])) {
            if (is_array($keyPlayers[1])) {
                $playersGame[] = setKeysTournament($keyPlayers);
            }

            if (is_string($keyPlayers[1])) {
                $playersGame[] = (new Player)->setName($keyPlayers[0])
                    ->setMove($keyPlayers[1]);
            }
        }
    }
    return $playersGame;
}
$playerGamesTournament = setKeysTournament($ArrPlayers);
$Rules = new Rules();
$Tournament = new Tournament($Rules);

$Tournament->rpsTournamentWinner($playerGamesTournament);
