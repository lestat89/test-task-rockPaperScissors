<?php

namespace App\Services\GameService;

/**
 * Interface GameServiceInterface
 * @package App\Services\GameService
 */
interface GameServiceInterface
{
    public const TYPE_RANDOM = 0;
    public const TYPE_ROCK = 1;
    public const TYPE_SCISSORS = 2;
    public const TYPE_PAPER = 3;

    public const TYPE_LIST = [
        self::TYPE_ROCK,
        self::TYPE_SCISSORS,
        self::TYPE_PAPER,
    ];

    public const PLAYER_ONE = 0;
    public const PLAYER_TWO = 1;


    public const DEFAULT_NUMBER_GAME = 100;
    public const DEFAULT_TYPE = self::TYPE_RANDOM;

    public function setNumberGames(int $numberGames): GameServiceInterface;

    public function getPlayers(): array;
    public function getNumberGames(): int;

    public function getPlayerMoves(int $type): int;

    public function run(): void;

    public function result(): string;
}
