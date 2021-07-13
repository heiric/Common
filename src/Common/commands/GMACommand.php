<?php

declare(strict_types=1);

namespace Common\commands;

use Common\Main;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;

class GMACommand extends PluginCommand {

    private $plugin;

    public function __construct(Main $plugin) {
        parent::__construct("gma", $plugin);
        $this->plugin = $plugin;
        $this->setPermission("common.gma");
        $this->setDescription("Set gamemode to Adventure");
        $this->setUsage("/gma [player]");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {
        if (!$sender instanceof Player) {
            $sender->sendMessage("§cThis command can only be used in-game!");
            return;
        }
        if(!$sender->hasPermission("common.gma")) {
            $sender->sendMessage("§cYou do not have permission to use this command!");
            return;
        }

        if (!isset($args[0])) {
            $sender->setGamemode(2);
            $sender->sendMessage("§aYour gamemode has been set to Adventure");
        } else {
            $player = Server::getInstance()->getPlayer(implode(" ", $args));
            if (!$player) {
                $sender->sendMessage("§cPlayer not found!");
                return;
            }
            if ($player->getDisplayName() == $sender->getDisplayName()) {
                $sender->setGamemode(2);
                $sender->sendMessage("§aYour gamemode has been set to Adventure");
                return;
            }
            $name = $player->getDisplayName();
            $player->setGamemode(2);
            $sender->sendMessage("§a{$name}'s gamemode has been set to Adventure");
        }
    }
}