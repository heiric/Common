<?php

declare(strict_types=1);

namespace Common\commands;

use Common\Main;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;

class TPOCommand extends PluginCommand {

    private $plugin;

    public function __construct(Main $plugin) {
        parent::__construct("tpo", $plugin);
        $this->plugin = $plugin;
        $this->setPermission("common.tpo");
        $this->setDescription("Teleport a player to you");
        $this->setUsage("/tpo (player)");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {
        if(!$sender instanceof Player) {
            $sender->sendMessage("§cThis command can only be used in-game!");
            return;
        }
        if (!$sender->hasPermission("common.tpo")) {
            $sender->sendMessage("§cYou do not have permission to use this command!");
            return ;
        }
        if (!isset($args[0])) {
            $sender->sendMessage("§cUsage: /tpo <player>");
            return;
        }
        $player = Server::getInstance()->getPlayer(implode(" ", $args));
        if (!$player) {
            $sender->sendMessage("§cPlayer not found!");
            return;
        }
        if ($player->getLevel() !== $sender->getLevel()) {
            $player->setLevel($sender->getLevel());
        }
        $name = $player->getName();
        $player->teleport($sender);
        $sender->sendMessage("§a{$name} has been teleported to you!");
    }
}