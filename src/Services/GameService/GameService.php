<?php

namespace App\Services\GameService;


use App\Entity\Player;

class GameService implements GameServiceInterface
{
    /**
     * @var Player[]
     */
    private array $players = [];

    /**
     * @var int
     */
    private int $numberGames = self::DEFAULT_NUMBER_GAME;

    /**
     * GameService constructor.
     */
    public function __construct()
    {
        $this->players = [
            self::PLAYER_ONE => (new Player())->setName('Player1')->setType(GameServiceInterface::TYPE_RANDOM),
            self::PLAYER_TWO => (new Player())->setName('Player2')->setType(GameServiceInterface::TYPE_PAPER),
        ];
    }

    /**
     * @return Player[]
     */
    public function getPlayers(): array
    {
        return $this->players;
    }

    /**
     * @return int
     */
    public function getNumberGames(): int
    {
        return $this->numberGames;
    }

    /**
     * @param int $numberGames
     * @return $this
     */
    public function setNumberGames(int $numberGames): self
    {
        $this->numberGames = $numberGames;

        return $this;
    }

    /**
     *
     */
    public function run(): void
    {
        $players = $this->getPlayers();

        for ($i = $this->numberGames; $i > 0; $i--) {
            /** @var Player $player */
            $moves = array_map(fn($player) => $this->getPlayerMoves($player->getType()), $players);

            $result = ($moves[self::PLAYER_ONE] - $moves[self::PLAYER_TWO]) % self::TYPE_PAPER;
            if ($result < 0) {
                $result += self::TYPE_PAPER;
            }
            switch ($result) {
                case 0:
                    $players[self::PLAYER_ONE]->upDraw();
                    $players[self::PLAYER_TWO]->upDraw();
                    break;
                case 1:
                    $players[self::PLAYER_ONE]->upLose();
                    $players[self::PLAYER_TWO]->upWins();
                    break;
                case 2:
                    $players[self::PLAYER_ONE]->upWins();
                    $players[self::PLAYER_TWO]->upLose();
                    break;
            }
        }
    }

    /**
     * @param int $type
     * @return int
     */
    public function getPlayerMoves(int $type): int
    {
        if ($type === self::TYPE_RANDOM) {
            return self::TYPE_LIST[array_rand(self::TYPE_LIST)];
        }

        return $type;
    }

    public function result(): string
    {
        $result = '';
        foreach ($this->getPlayers() as $player) {
            $result .= sprintf("%s: wins - %s, lose - %s, draw - %s \n",
                $player->getName(), $player->getWins(), $player->getLose(), $player->getDraw());
        }

        return $result;
    }
}
