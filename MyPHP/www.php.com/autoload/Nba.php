<?php
abstract class Nba {
    protected $player;
    final public function setPlayer($player){
        $this->player = $player;
    }
    public abstract function getplayer();
}