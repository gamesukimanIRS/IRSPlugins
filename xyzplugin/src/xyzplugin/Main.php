<?php

/*hajime te no orijinaru plugin
* (c)gamesukimanIRS
*/
/*
|~~~~~~~~|  |\     /|   /~~~~~\  ~~~~~  |~~~~\    /~~~~~\
|           | \   / |  /      |    |    |     |  /      |
|    ~~~~|  |  \_/  |  |______     |    |____/   |_______
|        |  |       |         |    |    |\__            |
|________|  |       |  \______|  __|__  |   \    \______|
(c)gamesukimanIRS

注意
コードは基本汚いです。関数とかもあったもの使ってるだけです
*/


namespace xyzplugin;

use pocketmine\Player;
use pocketmine\tile;
use pocketmine\tile\Sign;
use pocketmine\event\block\SignChangeEvent;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Server;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;

class Main extends PluginBase implements Listener{
  
	public function onEnable(){
		$PluginName = "xyzplugin+α";
		$version = "2.3.0";

    	$this->getServer()->getPluginManager()->registerEvents($this, $this);
    	$this->getlogger()->info($PluginName."Version:".$version."を読み込みました。作者:gamesukimanIRS");
    	$this->getlogger()->warning("製作者偽りと二次配布、改造、改造配布はおやめ下さい。");
    	$this->getlogger()->info("このプラグインを使用する際はどこかにプラグイン名「".$PluginName."」と作者名「gamesukimanIRS」を記載する事を推奨します。");
	}
   
  	public function onCommand(CommandSender $sender, Command $command, $label, array $args){
    	if($command->getName() == "xyz"){
    		if($sender instanceof Player){
        		$sender->getName();
        		$level = $sender->getLevel();
        		$l = $level->getFolderName();
        		$x = $sender->getX();
        		$y = $sender->getY();
        		$z = $sender->getZ();
        		$sender->sendMessage("§b[XYZ]§fあなたの座標は§aX=".$x."、§bY=".$y."、§dZ=".$z."、§eワールド=".$l."です。");
        		return true;
      		}else{
        		$this->getlogger()->warning("サーバー内で実行して下さい");
        	return true;
      		}
 		}elseif($command->getName() == "xyzhelp"){
 			switch ($args[0]) {
 				case 'cmd':
 					$sender->sendMessage("§b=====xyzplugin Commandヘルプ(1/1)=====");
 					$sender->sendMessage("§a/xyz §c- §aあなたがいる座標・ワールドを取得し表示します");
 					$sender->sendMessage("§a/xyzhelp §c- §aヘルプ(これ)を表示します");
 					$sender->sendMessage("§b====================================");
 					return true;
 					break;

 				case 'about':
 					$Version = "2.3.0";
 					$sender->sendMessage("§b=====xyzplugin Version".$Version."=====");
 					$sender->sendMessage("§aQ.xyzplugin とは？");
 					$sender->sendMessage("§cA.gamesukimanIRSが初めて作ったオリジナルプラグインです。");
 					$sender->sendMessage("§c 元々は/xyzコマンドだけでしたが、徐々に膨大になってきました。");
 					$sender->sendMessage("§aQ.主な機能は？");
 					$sender->sendMessage("§cA./xyzによる座標を取得、他に警告看板と許可証看板を立てる機能です");
 					$sender->sendMessage("");
 					$sender->sendMessage("§b=©CopyLight gamesukimanIRS All Rights Reversed=");
 					return true;
 					break;

 				case 'kanban':
 					switch ($args[1]) {
 						case'keikoku':
 							$sender->sendMessage("§b=====xyzplugin 警告看板ヘルプ(1/1)=====");
 							$sender->sendMessage("§a二行目に書く文字 §c- §a内容");
 							$sender->sendMessage("§amiti §c- §a道から最低1マス離して下さい");
 							$sender->sendMessage("§ahochi §c- §a30日以内に持ち主のログインがない場合撤去");
 							$sender->sendMessage("§atonari-tatemono §c- §a隣の建物から最低1マス離してください");
 							$sender->sendMessage("§atonari-hogo §c- §a隣の土地保護から最低1マス離してください");
 							$sender->sendMessage("§aarasi §c- §a荒らし物件/申告があれば修復します");
 							$sender->sendMessage("§amuimi-hogo §c- §a無意味な土地保護は禁止です");
 							$sender->sendMessage("§aganban §c- §a最低でも岩盤から1マス離してください");
 							$sender->sendMessage("§akuutyuu §c- §a空中建築は禁止です");
 							$sender->sendMessage("§atakasugi §c- §a建設高度は50ブロックまでです");
 							$sender->sendMessage("§atikakentiku §c- §a地下建築は禁止です");
 							$sender->sendMessage("§aokisugi-garasu §c- §aガラスの量を減らしてください");
 							$sender->sendMessage("§aokisugi-kougen §c- §a光源の量を減らしてください");
 							$sender->sendMessage("§aie §c- §aここに家を建てることはできません");
 							$sender->sendMessage("§ahyousatu §c- §a表札をつけてください");
 							$sender->sendMessage("§b====================================");
 							return true;
 							break;

 						case'kyokasyou':
 							$sender->sendMessage("§b=====xyzplugin 許可証看板ヘルプ(1/1)=====");
 							$sender->sendMessage("§a二行目に書く文字 §c- §a内容");
 							$sender->sendMessage("§agarasu §c- §aガラスの大量使用を許可");
 							$sender->sendMessage("§akougen §c- §a光源の大量使用を許可");
 							$sender->sendMessage("§amizu §c- §a水の使用を許可");
 							$sender->sendMessage("§atikakentiku §c- §a地下建築を許可");
 							$sender->sendMessage("§akuutyuu §c- §a空中建築を許可");
 							$sender->sendMessage("§atakai §c- §a建築最大高度超を許可");
 							$sender->sendMessage("§b====================================");
 							return true;
 							break;

 						default:
 							$sender->sendMessage("§b=====xyzplugin 看板ヘルプ(1/1)=====");
 							$sender->sendMessage("§a/xyzhelp kanban keikoku §c- §a警告看板のヘルプを表示します");
 							$sender->sendMessage("§a/xyzhelp kanban kyokasyou §c- §a許可証看板のヘルプを表示します");
 							$sender->sendMessage("§b====================================");
 							return true;
 							break;
 					}
 				break;
 				
 				default:
 					$sender->sendMessage("$b=====xyzpluginヘルプ=====");
 					$sender->sendMessage("§a/xyzhelp cmd §c- §axyzプラグインのコマンドのヘルプを表示します");
 					$sender->sendMessage("§a/xyzhelp kanban §c- §axyzプラグインの看板のヘルプを表示します");
 					$sender->sendMessage("§a/xyzhelp about §c- §aこのプラグインの詳細を表示します");
 					$sender->sendMessage("§b=======================");
 					return true;
 					break;
 			}
 		}
  	}
	public function onSignChange(SignChangeEvent $event){
		$text = $event->getLines();
		switch ($text[0]) {
			//下のcaseは気分が悪くなる恐れがありますのでご注意ください
			case 'oppai':
				$event->setLine(0,"§6下ネタはやめて下さい");
				$player = $event->getPlayer();
				$name = $player->getName();
				$player->kick("§cあなたの書いた看板を下ネタと判断しました", false);
				$this->getServer()->broadcastMessage($name."の書いた看板が下ネタと判断され、".$name."はサーバーからkickされました。");
				break;
			case 'おっぱい':
				$event->setLine(0,"§6下ネタはやめて下さい");
				$player = $event->getPlayer();
				$player->kick("§cあなたの書いた看板を下ネタと判断しました", false);
				$this->getServer()->broadcastMessage($name."の書いた看板が下ネタと判断され、".$name."はサーバーからkickされました。");
				break;
			case 'sex':
				$event->setLine(0,"§6下ネタはやめて下さい");
				$player = $event->getPlayer();
				$player->kick("§cあなたの書いた看板を下ネタと判断しました", false);
				$this->getServer()->broadcastMessage($name."の書いた看板が下ネタと判断され、".$name."はサーバーからkickされました。");
				break;
			case 'セックス':
				$event->setLine(0,"§6下ネタはやめて下さい");
				$player = $event->getPlayer();
				$player->kick("§cあなたの書いた看板を下ネタと判断しました", false);
				$this->getServer()->broadcastMessage($name."の書いた看板が下ネタと判断され、".$name."はサーバーからkickされました。");
				break;
			case 'tinko':
				$event->setLine(0,"§6下ネタはやめて下さい");
				$player = $event->getPlayer();
				$player->kick("§cあなたの書いた看板を下ネタと判断しました", false);
				$this->getServer()->broadcastMessage($name."の書いた看板が下ネタと判断され、".$name."はサーバーからkickされました。");
				break;
			case 'ちんこ':
				$event->setLine(0,"§6下ネタはやめて下さい");
				$player = $event->getPlayer();
				$player->kick("§cあなたの書いた看板を下ネタと判断しました", false);
				$this->getServer()->broadcastMessage($name."の書いた看板が下ネタと判断され、".$name."はサーバーからkickされました。");
				break;
			case 'manko':
				$event->setLine(0,"§6下ネタはやめて下さい");
				$player = $event->getPlayer();
				$player->kick("§cあなたの書いた看板を下ネタと判断しました", false);
				$this->getServer()->broadcastMessage($name."の書いた看板が下ネタと判断され、".$name."はサーバーからkickされました。");
				break;
			case 'まんこ':
				$event->setLine(0,"§6下ネタはやめて下さい");
				$player = $event->getPlayer();
				$player->kick("§cあなたの書いた看板を下ネタと判断しました", false);
				$this->getServer()->broadcastMessage($name."の書いた看板が下ネタと判断され、".$name."はサーバーからkickされました。");
				break;
			case 'sikosiko':
				$event->setLine(0,"§6下ネタはやめて下さい");
				$player = $event->getPlayer();
				$player->kick("§cあなたの書いた看板を下ネタと判断しました", false);
				$this->getServer()->broadcastMessage($name."の書いた看板が下ネタと判断され、".$name."はサーバーからkickされました。");
				break;
			case 'しこしこ':
				$event->setLine(0,"§6下ネタはやめて下さい");
				$player = $event->getPlayer();
				$player->kick("§cあなたの書いた看板を下ネタと判断しました", false);
				$this->getServer()->broadcastMessage($name."の書いた看板が下ネタと判断され、".$name."はサーバーからkickされました。");
				break;
			case 'シコシコ':
				$event->setLine(0,"§6下ネタはやめて下さい");
				$player = $event->getPlayer();
				$player->kick("§cあなたの書いた看板を下ネタと判断しました", false);
				$this->getServer()->broadcastMessage($name."の書いた看板が下ネタと判断され、".$name."はサーバーからkickされました。");
				break;
			case '4545':
				$event->setLine(0,"§6下ネタはやめて下さい");
				$player = $event->getPlayer();
				$player->kick("§cあなたの書いた看板を下ネタと判断しました", false);
				$this->getServer()->broadcastMessage($name."の書いた看板が下ネタと判断され、".$name."はサーバーからkickされました。");
				break;

		}
		$player = $event->getPlayer();
		if($player->isOp()){
			if($text[0] == "kyokasyou"){
				$reason = $text[2];
				$today = date("y/m/d");
				$name = $event->getPlayer()->getName();
				$daimei = "§b§lⓘ§r§b[許可証 ".$today."]";
				$name2 = "§a§l".$name."";
				$naiyou = "";
				switch ($text[1]) {
					/*見本※これをテンプレに【】を書き換えてくれれば動くと思います。下のコードも参考に(参考にならないかもだけど
					case '【ここを二段目に入力する文字】':
						$naiyou = "【どういう許可にするか。二段目に表示されるメッセージ。】";
						break;

					改造場所(改造許可場所)は以上です。改造するところもないのでそれ以外は基本触らないようにお願いします。
					*/
					case 'garasu':
						$naiyou = "§aガラスの大量使用を許可";
						break;

					case 'kougen':
						$naiyou = "§a光源の大量使用を許可";
						break;

					case 'mizu':
						$naiyou = "§a水の使用を許可";
						break;

					case 'tikakentiku':
						$naiyou = "§a地下建築を許可";
						break;

					case 'kuutyuu':
						$naiyou = "§a空中建築を許可";
						break;

					case 'takai':
						$naiyou = "§a建築最大高度超を許可";
						break;


					default:
						$daimei = "§c正しい形式で入力してください";
						$reason = "";
						$naiyou = "";
						$name2 = "";
						break;
				}
				if($reason == ""){
					$reason = "§c未記入";
				}
				$event->setLine(0,$daimei);
				$event->setLine(1,$naiyou);
				$event->setLine(2,"§d理由:§b".$reason."");
				$event->setLine(3,$name2);
		
			}elseif($text[0] == "bukken"){
				$todaym = date("m");
				$todayd = date("d");
				$name = $event->getPlayer()->getName();
				$daimei = "§l§6⚠§r§c警告:違法物件§l§6⚠";
				$name2 = "§l§b".$name."";
				switch ($text[1]) {
					/*見本※これをテンプレに【】を書き換えてくれれば動くと思います。下のコードも参考に(参考にならないかもだけど
					case '【ここを二段目に入力する文字】':
						$todaydd = 【警告から何日後に撤去するか※数字】;
						$daimei = "【題名を書き換える場合のみ。そのままの場合はこの行は消す。】";
						$reason = "【どういう警告にするか。二段目に表示されるメッセージ。】";
						break;

					改造場所(改造許可場所)は以上です。改造するところもないのでそれ以外は基本触らないようにお願いします。
					*/
					case 'miti':
						$todaydd = 10;
						$reason = "§a道から最低1マス離して下さい";
						break;
					case 'hochi':
						$todaydd = 30;
						$daimei = "§l§6⚠§r§c警告:放置物件§l§6⚠";
						$reason = "§a30日以内に持ち主のログインがない場合撤去";
						break;

					case 'tonari-tatemono':
						$todaydd = 10;
						$reason = "§a隣の建物から最低1マス離してください";
						break;

					case 'tonari-hogo':
						$todaydd = 10;
						$reason = "§a隣の土地保護から最低1マス離してください";
						break;

					case 'arasi':
						$todaydd = 15;
						$daimei = "§b§lⓘ§r§6注意:荒らし物件§l§bⓘ";
						$reason = "§a申告があれば修復します";
						break;

					case 'muimi-hogo':
						$todaydd = 7;
						$daimei = "§l§6⚠§r§c警告:違法土地保護§l§6⚠";
						$reason = "§a無意味な土地保護は禁止です";
						break;

					case 'ganban':
						$todaydd = 10;
						$reason = "§a最低でも岩盤から1マス離してください";
						break;

					case 'kuutyuu':
						$todaydd = 10;
						$reason = "§a空中建築は禁止です";
						break;

					case 'takasugi':
						$todaydd = 10;
						$reason = "§a建設高度は50ブロックまでです";
						break;

					case 'tikakentiku':
						$todaydd = 7;
						$reason = "§a地下建築は禁止です";
						break;

					case 'okisugi-garasu':
						$todaydd = 10;
						$reason = "§aガラスの量を減らしてください";
						break;

					case 'okisugi-kougen':
						$todaydd = 10;
						$reason = "§a光源の量を減らしてください";
						break;

					case 'ie':
						$todaydd = 3;
						$reason = "§aここに家を建てることはできません";
						break;

					case 'hyousatu':
						$todaydd = 10;
						$reason = "§a表札をつけてください";
						break;

					default:
						$daimei = "§c正しい形式でやり直してください";
						$reason = "";
						$today = "";
						$name = "";
						break;

				}
				$todayd = $todayd + $todaydd;
				if($todaym == 1 and $todayd >= 31){
					$todaym = "02";
					$todayd = "01";
				}elseif($todaym == 2 and $todayd >= 28){
					$todaym = "03";
					$todayd = "01";
				}elseif($todaym == 3 and $todayd >= 31){
					$todaym = "04";
					$todayd = "01";
				}elseif($todaym == 4 and $todayd >= 30){
					$todaym = "05";
					$todayd = "01";
				}elseif($todaym == 5 and $todayd >= 31){
					$todaym = "06";
					$todayd = "01";
				}elseif($todaym == 6 and $todayd >= 30){
					$todaym = "07";
					$todayd = "01";
				}elseif($todaym == 7 and $todayd >= 31){
					$todaym = "08";
					$todayd = "01";
				}elseif($todaym == 8 and $todayd >= 31){
					$todaym = "09";
					$todayd = "01";
				}elseif($todaym == 9 and $todayd >= 30){
					$todaym = "10";
					$todayd = "01";
				}elseif($todaym == 10 and $todayd >= 31){
					$todaym = "11";
					$todayd = "01";
				}elseif($todaym == 11 and $todayd >= 30){
					$todaym = "12";
					$todayd = "01";
				}elseif($todaym == 12 and $todayd >= 31){
					$todaym = "01";
					$todayd = "01";
				}
				$today = "§c撤去日　§d".$todaym."/".$todayd."";
				$event->setLine(0,$daimei);
				$event->setLine(1,$reason);
				$event->setLine(2,$today);
				$event->setLine(3,$name2);
			}
		}else{
			if($text[0] == "bukken"){
				$player->sendTip("§cあなたには警告看板を立てる権限がありません");
				return true;
			}elseif($text[0] == "kyokasyou"){
				$player->sendTip("§cあなたには許可証看板を立てる権限がありません");
				return true;
			}
		}
	}
}
