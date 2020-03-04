<?php

namespace App\Entity;

use App\Services\GameService\GameServiceInterface;

/**
 * Class Player
 * @package App\Entity
 */
class Player
{
    private string $name = 'Player';
    private int $type = GameServiceInterface::DEFAULT_TYPE;

    private int $wins = 0;
    private int $lose = 0;
    private int $draw = 0;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Player
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * @param int $type
     * @return Player
     */
    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return int
     */
    public function getWins(): int
    {
        return $this->wins;
    }

    /**
     *
     */
    public function upWins(): void
    {
         ++$this->wins;
    }

    /**
     * @return int
     */
    public function getLose(): int
    {
        return $this->lose;
    }

    /**
     *
     */
    public function upLose(): void
    {
        ++$this->lose;
    }

    /**
     * @return int
     */
    public function getDraw(): int
    {
        return $this->draw;
    }

    /**
     *
     */
    public function upDraw(): void
    {
        ++$this->draw;
    }
}
