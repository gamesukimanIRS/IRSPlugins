<?php

/*getCUUID (c)gamesukimanIRS

|~~~~~~~~|  |\     /|   /~~~~~\  ~~~~~  |~~~~\    /~~~~~\
|           | \   / |  /      |    |    |     |  /      |
|    ~~~~|  |  \_/  |  |______     |    |____/   |_______
|        |  |       |         |    |    |\__            |
|________|  |       |  \______|  __|__  |   \    \______|

(c)gamesukimanIRS
*/

namespace getCUUID;

use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\Config;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;

class Main extends PluginBase implements Listener{

	public function onEnable(){
		$this->getlogger()->info("getCUUIDを読み込みました。作者:gamesukimanIRS");
    	$this->getlogger()->warning("製作者偽りと二次配布、改造、改造配布はおやめ下さい。");
    	$this->getlogger()->info("このプラグインを使用する際はどこかにプラグイン名「getCUUID」と作者名「gamesukimanIRS」を記載する事を推奨します。");
		if(!file_exists($this->getDataFolder())){
			mkdir($this->getDataFolder(), 0744, true);
		}
		$this->ConfigIp = new Config($this->getDataFolder() . "ip.yml", Config::YAML);
		$this->ConfigHost = new Config($this->getDataFolder() . "host.yml", Config::YAML);
		$this->ConfigCid = new Config($this->getDataFolder() . "cid.yml", Config::YAML);
		$this->ConfigUuid = new Config($this->getDataFolder() . "uuid.yml", Config::YAML);
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}

	public function onPlayerJoin(PlayerJoinEvent $event){
		$player = $event->getPlayer();
		$ip = $player->getAddress();
		$host = gethostbyaddr($player->getAddress());
		$cid = $player->getClientId();
		$uuid = $player->getUniqueId();
		$name = $player->getName();
		if($this->ConfigIp->exists($name)){
			$registerip = $this->ConfigIp->get();
			if($registerip == $ip){
				#ｽﾙー('ω' )))≡3ーｯ
			}else{
				$this->ConfigIp->set($name, $ip);
				$this->ConfigIp->save();
				$this->getLogger()->Notice($name."のIPは記録されてるものと違います。Configに記録されている".$name."のIPを更新しました。");
			}
		}else{
			$this->ConfigIp->set($name, $ip);
			$this->ConfigIp->save();
			$this->getLogger()->Notice($name."のIPを新しく記録しました。");
		}
		if($this->ConfigHost->exists($name)){
			$registerhost = $this->ConfigHost->get();
			if($registerhost == $host){
				#ｽﾙー('ω' )))≡3ーｯ
			}else{
				$this->ConfigHost->set($name, $host);
				$this->ConfigHost->save();
				$this->getLogger()->Notice($name."のHostは記録されてるものと違います。Configに記録されている".$name."のHostを更新しました。");
			}
		}else{
			$this->ConfigHost->set($name, $host);
			$this->ConfigHost->save();
			$this->getLogger()->Notice($name."のHostを新しく記録しました。");
		}
		if($this->ConfigCid->exists($name)){
			$registercid = $this->ConfigCid->get();
			if($registercid == $cid){
				#ｽﾙー('ω' )))≡3ーｯ
			}else{
				$this->ConfigCid->set($name, $cid);
				$this->ConfigCid->save();
				$this->getLogger()->Notice($name."のCidは記録されてるものと違います。Configに記録されている".$name."のCidを更新しました。");
			}
		}else{
			$this->ConfigCid->set($name, $cid);
			$this->ConfigCid->save();
			$this->getLogger()->Notice($name."のCidを新しく記録しました。");
		}
		if($this->ConfigUuid->exists($name)){
			$registeruuid = $this->ConfigUuid->get();
			if($registeruuid == $uuid){
				#ｽﾙー('ω' )))≡3ーｯ
			}else{
				$this->ConfigUuid->set($name, $uuid);
				$this->ConfigUuid->save();
				$this->getLogger()->Notice($name."のUUIDは記録されてるものと違います。Configに記録されている".$name."のUUIDを更新しました。");
			}
		}else{
			$this->ConfigUuid->set($name, $uuid);
			$this->ConfigUuid->save();
			$this->getLogger()->Notice($name."のUUIDを新しく記録しました。");
		}
	}

	public function onCommand(CommandSender $sender, Command $command, $label, array $args){
		switch ($command->getName()){
			case 'getip':
				$target = $args[0];
				if($target == ""){
					$sender->sendMessage("§cプレイヤー名を入力してください。");
					return true;
				}else{
					if($this->ConfigIp->exists($target)){
						$ip = $this->ConfigIp->get($target);
						$sender->sendMessage($target."の記録されているIPは".$ip."です。");
						return true;
					}else{
						$sender->sendMessage($target."のIPは記録されていません");
						return true;
					}
				}
				break;

			case 'gethost':
				$target = $args[0];
				if($target == ""){
					$sender->sendMessage("§cプレイヤー名を入力してください。");
					return true;
				}else{
					if($this->ConfigHost->exists($target)){
						$host = $this->ConfigHost->get($target);
						$sender->sendMessage($target."の記録されているHostは".$host."です。");
						return true;
					}else{
						$sender->sendMessage($target."のHostは記録されていません");
						return true;
					}
				}
				break;

			case 'getcid':
				$target = $args[0];
				if($target == ""){
					$sender->sendMessage("§cプレイヤー名を入力してください。");
					return true;
				}else{
					if($this->ConfigCid->exists($target)){
						$cid = $this->ConfigCid->get($target);
						$sender->sendMessage($target."の記録されているCIDは".$cid."です。");
						return true;
					}else{
						$sender->sendMessage($target."のCidは記録されていません");
						return true;
					}
				}
				break;

			case 'getuuid':
				$target = $args[0];
				if($target == ""){
					$sender->sendMessage("§cプレイヤー名を入力してください。");
					return true;
				}else{
					if($this->ConfigUuid->exists($target)){
						$uuid = $this->ConfigUuid->get($target);
						$sender->sendMessage($target."の記録されているUUIDは".$uuid."です。");
						return true;
					}else{
						$sender->sendMessage($target."のUUIDは記録されていません");
						return true;
					}
				}
				break;
		}
	}
}
