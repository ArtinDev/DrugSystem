<?php

namespace  ArtinHector\DrugSystem;

use pocketmine\Server;
use pocketmine\Player;
use pocketmine\item\Item;
use pocketmine\math\Vector3;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\player\PlayerItemConsumeEvent;
use pocketmine\level\particle\FloatingTextParticle;
use pocketmine\entity\Effect;
use pocketmine\entity\EffectInstance;
use ArtinHector\DrugSystem\dropTask;

class Main extends PluginBase implements Listener{
	
	public const MS = "§c[§b DrugSystem §c] : §a";
	public const ER = "§c[§b DrugSystem §c] : §c";

    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onBreak(BlockBreakEvent $event){
        $player = $event->getPlayer();
        $block = $event->getBlock();
        $itm = Item::get(464);
        if ($player->hasPermission("drug.p")){
            if ($block->getId() == 25) {
                $event->setCancelled();
                $txt = "§e--------------------\n§6Drug System\n§e--------------------";
                $block->getLevel()->addParticle(new FloatingTextParticle(new Vector3($block->getX() + 0.5, $block->getY() + 2, $block->getZ() + 0.5), $txt));
                $block->getLevel()->setBlockIdAt($block->getX(), $block->getY(), $block->getZ(), 25);
                $this->getScheduler()->scheduleRepeatingTask(new dropTask($this, $player, $block, $itm), 20);
            }
        } else {
            $player->sendPopup(self::ER . "You No Not Have Permission To Use This Feature");
        }
    }

    public function onConsume(PlayerItemConsumeEvent $event){
        $item = $event->getItem();
        $player = $event->getPlayer();
        if($event->getItem()->getId() === 464){
            $item->pop();
            $player->getInventory()->setItemInHand($item);
            $player->addEffect(new EffectInstance(Effect::getEffect(Effect::NAUSEA), 180*20, 1, true));
            $player->addEffect(new EffectInstance(Effect::getEffect(Effect::HEALTH_BOOST), 180*20, 2, true));
            $player->addEffect(new EffectInstance(Effect::getEffect(Effect::POISON), 180*20, 1, true));
            $player->addEffect(new EffectInstance(Effect::getEffect(Effect::SATURATION), 180*20, 1, true));
            return;
        }
    }
}
