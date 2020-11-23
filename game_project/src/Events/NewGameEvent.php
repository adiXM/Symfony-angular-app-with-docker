<?php
namespace App\Events;

use App\Service\PlayersService;
use Symfony\Contracts\EventDispatcher\Event;
use App\Entity\Game;

class NewGameEvent extends Event
{
    const NAME = 'newgame.created';

    protected $game;
    public function __construct(Game $game)
    {
        $this->game = $game;
    }

    public function getGame()
    {
        return $this->game;
    }
}