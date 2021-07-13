<?php

declare(strict_types=1);

namespace Common;

use Common\commands\GMSCommand;
use Common\commands\GMCCommand;
use Common\commands\GMACommand;
use Common\commands\GMSPCCommand;
use Common\commands\TPOCommand;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase implements Listener{

    public function onEnable() : void {
        $this->getServer()->getPluginManager()->registerEvents(new onListener($this), $this);
        $this->getServer()->getCommandMap()->register("tpo", new TPOCommand($this));
        $this->getServer()->getCommandMap()->register("gms", new GMSCommand($this));
        $this->getServer()->getCommandMap()->register("gmc", new GMCCommand($this));
        $this->getServer()->getCommandMap()->register("gma", new GMACommand($this));
        $this->getServer()->getCommandMap()->register("gmspc", new GMSPCCommand($this));
    }
}