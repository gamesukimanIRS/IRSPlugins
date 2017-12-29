<?php
namespace Jisatu;
use pocketmine\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;

class Main extends PluginBase implements Listener {

	public function onEnable(){
		$this->getlogger()->info("Jisatuを読み込みました。作者:gamesukimanIRS");
		$this->getlogger()->warning("製作者偽りと二次配布、改造、改造配布はおやめ下さい。");
		$this->getlogger()->info("このプラグインを使用する際はどこかにプラグイン名「Jisatu」と作者名「gamesukimanIRS」を記載する事を推奨します。");
	}

	public function onCommand(CommandSender $sender, Command $command, $label, array $args){
		if($command->getName() == "shinu"){
			if($sender instanceof Player){
				$sender->setHealth(0);
				$n = $sender->getName();
				$sender->sendMessage("[Jisatu]自殺しました。");
				$this->getServer()->broadcastMessage("[Jisatu]".$n."が自殺しました。なんの悩みが...");

			}else{
				$this->getLogger()->warning("サーバー内で実行してください。");
				return true;
			}
		}
	}
}
