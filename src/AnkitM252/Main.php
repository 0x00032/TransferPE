<?php
namespace AnkitM252;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat as TF;
use pocketmine\command\{Command,CommandSender};

class Main extends PluginBase implements Listener{

	public function onEnable(): void{
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getLogger()->info(TF::GREEN . "TransferPE has been enabled!");
	}

	public function onCommand(CommandSender $sender, Command $command, $labels, array $args): bool{
		$cmd = strtolower($command->getName());

		if($cmd == "transferpe"){
			if(isset($args[0]) && isset($args[1]) && isset($args[2])){
				$player = $this->getServer()->getPlayer($args[0]);
				$ip = $args[1];
				$port = $args[0];
				if($player == null){
					$sender->sendMessage(TF::RED . "That player is not online");
				} else {
					$player->sendMessage(TF::GREEN . "You are being transfered to ". $ip .":".$port);
					$sender->sendMessage(TF::GREEN . "You transfered" . $player . "to: ". $ip .":".$port);
					$player->transfer($ip, $port);
				}
			} else {
				$sender->sendMessage(TF::RED . "Usage: /transferpe <player> <ip> <port>");
			}
		}

		return true;
	}

	public function onDisable(){
		$this->getLogger()->info(TF::RED . "TransferPE has been disabled!");
	}

}
