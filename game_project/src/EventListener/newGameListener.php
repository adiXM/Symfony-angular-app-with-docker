<?php

use Symfony\Contracts\EventDispatcher\Event;

class GameListener
{
    public function onCreatedNewGameAction(Event $event)
    {
        //here you can populate the players with your data from anywhere
        $event->getGame()->setPlayers(rand(30, 100));
    }
}