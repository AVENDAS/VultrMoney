<?php

namespace vultrmoney;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\Config;
//LinkAGE
use vultrmoney\command\GiveMoneyCommand;
use vultrmoney\command\TopMoneyCommand;
use vultrmoney\command\PayMoneyCommand;
use vultrmoney\command\RemoveMoneyCommand;
use vultrmoney\command\SetMoneyCommand;
use vultrmoney\command\MyMoneyCommand;
use vultrmoney\command\SeeMoneyCommand;

class Main extends PluginBase implements Listener {
  private static $instance = null;
  public $money, $mDB;
  public $tag = "§c§l[VultrlM]§7§o";
  public function onEnable () {
   $this->money = new Config ( $this->getDataFolder () . "money.yml", Config::YAML );
   $this->mDB = $this->money->getAll ();
   $this->getServer ()->getPluginManager ()->registerEvents ( $this, $this );  
   $this->registerCommand ();
  }
  public function registerCommnd () {
    $this->PayMoneyCommand = new PayMoneyCommand ( $this );
    $this->SetMoneyCommand = new SetMoneyCommand ( $this );
    $this->MyMoneyCommand = new MyMoneyCommand ( $this );
    $this->GiveMoneyCommand = new GiveMoneyCommand ( $this );
    $this->TopMoneyCommand = new TopMoneyCommand ( $this );
    $this->SeeMoneyCommand = new SeeMoneyCommand ( $this );
  }
  public function getMessage (Player $player) {
    if ($player->isOp ()) {   
      $player->sendMessage ( $this->tag . " /내돈 - 자신의 돈을 확인" );
      $player->sendMessage ( $this->tag . " /돈보기 [닉네임] - [닉네임]의 돈을 확인" );   
      $player->sendMessage ( $this->tag . " /돈순위 [페이지] - 돈순위를 봅니다." );   
      $player->sendMessage ( $this->tag . " /돈순위 [페이지] - 돈순위를 봅니다." );
      $player->sendMessage ( $this->tag . " /돈설정 [닉네임] [금액] - [닉네임]의 돈을 [금액]으로 설정합니다." );   
      $player->sendMessage ( $this->tag . " /돈뺏기 [닉네임] [금액] - [닉네임]의 돈을 [금액]만큼 뺏습니다." );
}
