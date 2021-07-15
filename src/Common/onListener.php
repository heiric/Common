<?php

declare(strict_types=1);

namespace Common;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerExhaustEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;

class onListener implements Listener {

    private $plugin;

    public function __construct(Main $plugin) {
        $this->plugin = $plugin;
    }

    public function onExhaust(PlayerExhaustEvent $event) : void {
        $event->setCancelled(true);
    }

    public function onFallDamage(EntityDamageEvent $event) : void {
        if ($event->getCause(4)) {
            $event->setCancelled(true);
        }
    }

    public function onJoin(PlayerJoinEvent $event) : void {
        $player = $event->getPlayer();
        $name = $player->getDisplayName();

        $player->setHealth(20);
        $event->setJoinMessage("§8[§a+§8] {$name}");
        $player->teleport($player->getLevel()->getSpawnLocation());
    }

    public function onQuit(PlayerQuitEvent $event) : void {
        $player = $event->getPlayer()->getDisplayName();
        $event->setQuitMessage("§8[§c-§8] {$player}");
    }

    public function onBreak(BlockBreakEvent $event) : void {
        $player = $event->getPlayer();
        if (!$player->hasPermission("pocketmine.command.op")) {
            $event->setCancelled(true);
        }
    }

    public function onPlace(BlockPlaceEvent $event) : void {
        $player = $event->getPlayer();
        if (!$player->hasPermission("pocketmine.command.op")) {
            $event->setCancelled(true);
        }
    }
}