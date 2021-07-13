<?php

declare(strict_types=1);

namespace Common;

use pocketmine\Player;
use pocketmine\Server;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\plugin\PluginBase;

class MainClass extends PluginBase {

    public function onEnable() : void {
        $this->getServer()->getPluginManager()->registerEvents(new xListener($this), $this);
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool {

        switch($command->getName()) {
            case "hello":
                $sender->sendMessage("§aHowdy, " . $sender->getName() . "!");
                return true;
            case "gms":
                if (!$sender instanceof Player) {
                    $sender->sendMessage("§cThis command can only be used in-game!");
                    return true;
                }
                if(!$sender->hasPermission("common.gms")) {
                    $sender->sendMessage("§cYou do not have permission to use this command!");
                    return true;
                }

                if (!isset($args[0])) {
                    $sender->setGamemode(0);
                    $sender->sendMessage("§aYour gamemode has been set to Survival");
                    return true;
                } else {
                    $player = Server::getInstance()->getPlayer(implode(" ", $args));
                    if (!$player) {
                        $sender->sendMessage("§cPlayer not found!");
                        return true;
                    }
                    if ($player->getDisplayName() == $sender->getDisplayName()) {
                        $sender->setGamemode(0);
                        $sender->sendMessage("§aYour gamemode has been set to Survival");
                        return true;
                    }
                    $name = $player->getDisplayName();
                    $player->setGamemode(0);
                    $sender->sendMessage("§a{$name}'s gamemode has been set to Survival!");
                    return true;
                }
            case "gmc":
                if (!$sender instanceof Player) {
                    $sender->sendMessage("§cThis command can only be used in-game!");
                    return true;
                }
                if(!$sender->hasPermission("common.gmc")) {
                    $sender->sendMessage("§cYou do not have permission to use this command!");
                    return true;
                }

                if (!isset($args[0])) {
                    $sender->setGamemode(1);
                    $sender->sendMessage("§aYour gamemode has been set to Creative");
                    return true;
                } else {
                    $player = Server::getInstance()->getPlayer(implode(" ", $args));
                    if (!$player) {
                        $sender->sendMessage("§cPlayer not found!");
                        return true;
                    }
                    if ($player->getDisplayName() == $sender->getDisplayName()) {
                        $sender->setGamemode(1);
                        $sender->sendMessage("§aYour gamemode has been set to Creative");
                        return true;
                    }
                    $name = $player->getDisplayName();
                    $player->setGamemode(1);
                    $sender->sendMessage("§a{$name}'s gamemode has been set to Creative!");
                    return true;
                }
            case "gma":
                if (!$sender instanceof Player) {
                    $sender->sendMessage("§cThis command can only be used in-game!");
                    return true;
                }
                if(!$sender->hasPermission("common.gma")) {
                    $sender->sendMessage("§cYou do not have permission to use this command!");
                    return true;
                }

                if (!isset($args[0])) {
                    $sender->setGamemode(2);
                    $sender->sendMessage("§aYour gamemode has been set to Adventure");
                    return true;
                } else {
                    $player = Server::getInstance()->getPlayer(implode(" ", $args));
                    if (!$player) {
                        $sender->sendMessage("§cPlayer not found!");
                        return true;
                    }
                    if ($player->getDisplayName() == $sender->getDisplayName()) {
                        $sender->setGamemode(2);
                        $sender->sendMessage("§aYour gamemode has been set to Adventure");
                        return true;
                    }
                    $name = $player->getDisplayName();
                    $player->setGamemode(2);
                    $sender->sendMessage("§a{$name}'s gamemode has been set to Adventure!");
                    return true;
                }
            case "gmspc":
                if (!$sender instanceof Player) {
                    $sender->sendMessage("§cThis command can only be used in-game!");
                    return true;
                }
                if(!$sender->hasPermission("common.gmspc")) {
                    $sender->sendMessage("§cYou do not have permission to use this command!");
                    return true;
                }

                if (!isset($args[0])) {
                    $sender->setGamemode(3);
                    $sender->sendMessage("§aYour gamemode has been set to Spectator");
                    return true;
                } else {
                    $player = Server::getInstance()->getPlayer(implode(" ", $args));
                    if (!$player) {
                        $sender->sendMessage("§cPlayer not found!");
                        return true;
                    }
                    if ($player->getDisplayName() == $sender->getDisplayName()) {
                        $sender->setGamemode(3);
                        $sender->sendMessage("§aYour gamemode has been set to Spectator");
                        return true;
                    }
                    $name = $player->getDisplayName();
                    $player->setGamemode(3);
                    $sender->sendMessage("§a{$name}'s gamemode has been set to Spectator!");
                    return true;
                }
            case "tpo":
                if(!$sender instanceof Player) {
                    $sender->sendMessage("§cThis command can only be used in-game!");
                    return true;
                }
                if (!$sender->hasPermission("common.tpo")) {
                    $sender->sendMessage("§cYou do not have permission to use this command!");
                    return true;
                }
                if (!isset($args[0])) {
                    $sender->sendMessage("§cUsage: /tpo <player>");
                    return true;
                }
                $player = Server::getInstance()->getPlayer(implode(" ", $args));
                if (!$player) {
                    $sender->sendMessage("§cPlayer not found!");
                    return true;
                }
                if ($player->getLevel() !== $sender->getLevel()) {
                    $player->setLevel($sender->getLevel());
                }
                $name = $player->getName();
                $player->teleport($sender);
                $sender->sendMessage("§a{$name} has been teleported to you!");
                return true;
        }
    }
}