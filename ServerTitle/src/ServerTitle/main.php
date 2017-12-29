<?php

namespace ServerTitle;

use pocketmine\Player;
use pocketmine\utils\Config;
use pocketmine\Server;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\utils\TextFormat;
use pocketmine\scheduler\PluginTask;

class main extends PluginBase implements Listener{

  public function onEnable(){
    $this->getServer()->getPluginManager()->registerEvents($this,$this);
    $this->getlogger()->info("ServerTitleを読み込みました。作者:gamesukimanIRS");
    $this->getlogger()->warning("製作者偽りと二次配布、改造、改造配布はおやめ下さい。");
    $this->getlogger()->info("このプラグインを使用する際はどこかにプラグイン名「ServerTitle」と作者名「gamesukimanIRS」を記載する事を推奨します。");

       if(!file_exists($this->getDataFolder())){ 
          mkdir($this->getDataFolder(), 0756, true); 
       }
       $this->Config = new Config($this->getDataFolder() . "ServerTitle.yml", Config::YAML, array(
        'serverName' => '§l§bMinecraft:PE Server',
        'serverVersion' => 'MCPE for x.x.x'
        ));
  }
  public function onPlayerJoin(PlayerJoinEvent $event){
    $player = $event->getPlayer();  
    $task = new Send($this,$player);
    $this->getServer()->getScheduler()->scheduleDelayedTask($task,20);
  }
}
class Send extends PluginTask{

  public function __construct(PluginBase $owner,Player $player){
      parent::__construct($owner);
      $this->player = $player;
  }
  public function onRun($tick){
    $this->Config = $this->owner->Config;
    $title = $this->Config->get("serverName");
    $subtitle = $this->Config->get("serverVersion");
    if($title == ""){
      $this->Config->set("serverName", "§l§bMinecraft:PE Server");
      $this->Config->save();
    }
    if($subtitle == ""){
      $this->Config->set("serverVersion", "MCPE for x.x.x");
      $this->Config->save();
    }
    $title = $this->Config->get("serverName");
    $subtitle = $this->Config->get("serverVersion");
    $this->player->addTitle("".$title."", "".$subtitle."", "20", "20", "20");
  }
}
?>
