<?php

namespace onebone\economyapi\command;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;
use pocketmine\Player;

use onebone\economyapi\EconomyAPI;

class FloorCommand extends Command{
	private $plugin;

	public function __construct(EconomyAPI $plugin){
		$desc = $plugin->getCommandMessage("floor");
		parent::__construct("floor", $desc["description"], $desc["usage"]);

		$this->setPermission("economyapi.command.floor");

		$this->plugin = $plugin;
	}
	public function execute(CommandSender $sender, string $label, array $params): bool{
		if ($sender instanceof Player) {
			$mymoney = $this->plugin->myMoney($sender->getName());
			$mny=floor($mymoney);
			$this->plugin->setMoney($sender->getName(),$mny);
			$sender->sendMessage("切り捨てました");
		}
	}
}