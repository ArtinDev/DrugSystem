<?php

namespace ArtinHector\DrugSystem;

use ArtinHector\DrugSystem\Main;
use pocketmine\Server;
use pocketmine\Player;
use pocketmine\math\Vector3;
use pocketmine\scheduler\Task;

class dropTask extends Task{

    public $time = 15;
    public $main;
    public $player;
    public $bl;
    public $itm;

    public function __construct(Main $main, Player $player, $bl, $itm){
        $this->main = $main;
        $this->player = $player;
        $this->bl = $bl;
        $this->itm = $itm;
    }

    public function onRun(int $currentTick){
        $player = $this->player;
        $itm = $this->itm;
        if($this->time <= 0){
            $this->main->getScheduler()->cancelTask($this->getTaskId());
            $player->sendMessage(main::MS . "Your Drug Was Made In [  5  ] Number !!");
        }else{
            if($this->time == 3){
                $player->getLevelNonNull()->dropItem(new Vector3($this->bl->getX(), $this->bl->getY() + 1, $this->bl->getZ()), $itm);
                $player->sendPopup(main::MS . "[  5  ] : Drug At The Moment Is !");
            }
            if($this->time == 6){
                $player->getLevelNonNull()->dropItem(new Vector3($this->bl->getX(), $this->bl->getY() + 1, $this->bl->getZ()), $itm);
                $player->sendPopup(main::MS . "[  4  ] : Drug At The Moment Is !");
            }
            if($this->time == 9){
                $player->getLevelNonNull()->dropItem(new Vector3($this->bl->getX(), $this->bl->getY() + 1, $this->bl->getZ()), $itm);
                $player->sendPopup(main::MS . "[  3  ] : Drug At The Moment Is !");
            }
            if($this->time == 12){
                $player->getLevelNonNull()->dropItem(new Vector3($this->bl->getX(), $this->bl->getY() + 1, $this->bl->getZ()), $itm);
                $player->sendPopup(main::MS . "[  2  ] : Drug At The Moment Is !");
            }
            if($this->time == 15){
                $player->getLevelNonNull()->dropItem(new Vector3($this->bl->getX(), $this->bl->getY() + 1, $this->bl->getZ()), $itm);
                $player->sendPopup(main::MS . "[  1  ] : Drug At The Moment Is !");
            }
            $this->time--;
        }
    }
}
