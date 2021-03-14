<?php
class Rocket extends Nba {
    protected $player;
    public function getPlayer()
    {
        echo $this->player."<br>";
    }
}