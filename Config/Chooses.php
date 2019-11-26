<?php
namespace RockPaperScissor\Config;

/**
 * Classe Chooses
 * 
 * @name Chooses
 * @author renan.zanelato <renan.zanelato@gazin.com.br>
 * @date   26/11/2019
 * @access public
 */
class Chooses
{

    const ROCK = 'R';
    const PAPER = 'P';
    const SCISSORS = 'S';

    public static function getValidMove()
    {
        return [self::ROCK, self::PAPER, self::SCISSORS];
    }
}
