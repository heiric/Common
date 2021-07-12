<?php

declare(strict_types=1);

namespace Common;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerRespawnEvent;
use pocketmine\event\entity\EntityDamageEvent;

class xListener implements Listener {

    private $plugin;

    public function __construct(MainClass $plugin) {
        $this->plugin = $plugin;
    }

    public function onSpawn(PlayerRespawnEvent $event) : void {
        $this->plugin->getServer()->broadcastMessage($event->getPlayer()->getDisplayName() . " has just spawned!");
    }

    public function onFallDamage(EntityDamageEvent $event) : void {
        if ($event->getCause(4)) {
            $event->setCancelled(true);
        }
    }
}