<?php
namespace RockPaperScissor\Entities;

/**
 * Classe Player
 * 
 * @name Player
 * @author renan.zanelato <renan.zanelato@gazin.com.br>
 * @date   26/11/2019
 * @access public
 */
class Player
{

    private $name;
    private $move;

    public function getName()
    {
        return $this->name;
    }

    public function getMove()
    {
        return $this->move;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function setMove($move)
    {
        $this->move = strtoupper($move);
        return $this;
    }
}
