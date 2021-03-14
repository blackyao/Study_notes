<?php
class Nets extends Nba {
    protected $player;
    public function getPlayer()
    {
        echo $this->player."<br>";
    }
}