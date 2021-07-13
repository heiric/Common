<?php

declare(strict_types=1);

namespace Common\commands;

use Common\Main;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;

class GMSPCCommand extends PluginCommand {

    private $plugin;

    public function __construct(Main $plugin) {
        parent::__construct("gmspc", $plugin);
        $this->plugin = $plugin;
        $this->setPermission("common.gmspc");
        $this->setDescription("Set gamemode to Spectator");
        $this->setUsage("/gmspc [player]");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {
        if (!$sender instanceof Player) {
            $sender->sendMessage("§cThis command can only be used in-game!");
            return;
        }
        if(!$sender->hasPermission("common.gmspc")) {
            $sender->sendMessage("§cYou do not have permission to use this command!");
            return;
        }

        if (!isset($args[0])) {
            $sender->setGamemode(3);
            $sender->sendMessage("§aYour gamemode has been set to Spectator");
        } else {
            $player = Server::getInstance()->getPlayer(implode(" ", $args));
            if (!$player) {
                $sender->sendMessage("§cPlayer not found!");
                return;
            }
            if ($player->getDisplayName() == $sender->getDisplayName()) {
                $sender->setGamemode(3);
                $sender->sendMessage("§aYour gamemode has been set to Spectator");
                return;
            }
            $name = $player->getDisplayName();
            $player->setGamemode(3);
            $sender->sendMessage("§a{$name}'s gamemode has been set to Spectator");
        }
    }
}