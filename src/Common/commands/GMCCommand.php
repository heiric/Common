<?php

declare(strict_types=1);

namespace Common\commands;

use Common\Main;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;

class GMCCommand extends PluginCommand {

    private $plugin;

    public function __construct(Main $plugin) {
        parent::__construct("gmc", $plugin);
        $this->plugin = $plugin;
        $this->setPermission("common.gmc");
        $this->setDescription("Set gamemode to Creative");
        $this->setUsage("/gmc [player]");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {
        if (!$sender instanceof Player) {
            $sender->sendMessage("§cThis command can only be used in-game!");
            return;
        }
        if(!$sender->hasPermission("common.gmc")) {
            $sender->sendMessage("§cYou do not have permission to use this command!");
            return;
        }

        if (!isset($args[0])) {
            $sender->setGamemode(1);
            $sender->sendMessage("§aYour gamemode has been set to Creative");
        } else {
            $player = Server::getInstance()->getPlayer(implode(" ", $args));
            if (!$player) {
                $sender->sendMessage("§cPlayer not found!");
                return;
            }
            if ($player->getDisplayName() == $sender->getDisplayName()) {
                $sender->setGamemode(1);
                $sender->sendMessage("§aYour gamemode has been set to Creative");
                return ;
            }
            $name = $player->getDisplayName();
            $player->setGamemode(1);
            $sender->sendMessage("§a{$name}'s gamemode has been set to Creative");
        }
    }
}