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
