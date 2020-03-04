<?php

namespace App\Tests\GameService;

use App\Entity\Player;
use App\Services\GameService\GameService;
use App\Services\GameService\GameServiceInterface;
use PHPUnit\Framework\TestCase;

/**
 * Class GameServiceTest
 * @package App\Tests\SimpleQuery
 */
class GameServiceTest extends TestCase
{
    /**
     * @return GameService
     */
    public function testGameService(): GameService
    {
        $gameService = new GameService();
        $this->assertIsObject($gameService);

        return $gameService;
    }

    /**
     * @depends testGameService
     * @param GameService $gameService
     */
    public function testGetPlayers(GameService $gameService): void
    {
        $players = $gameService->getPlayers();
        $this->assertCount(2, $players);
        foreach ($players as $player) {
            $this->assertInstanceOf(Player::class, $player);
        }
    }

    /**
     * @depends testGameService
     * @param GameService $gameService
     */
    public function testNumberGames(GameService $gameService): void
    {
        $numberGames = 100;
        $gameService->setNumberGames($numberGames);
        $this->assertEquals($numberGames, $gameService->getNumberGames());
    }

    /**
     * @depends testGameService
     * @param GameService $gameService
     */
    public function testPlayerMoves(GameService $gameService): void
    {
        $this->assertEquals(GameServiceInterface::TYPE_PAPER,
            $gameService->getPlayerMoves(GameServiceInterface::TYPE_PAPER));

        $this->assertThat($gameService->getPlayerMoves(GameServiceInterface::TYPE_RANDOM),
            $this->logicalAnd($this->greaterThan(0), $this->lessThan(4))
        );
    }

    /**
     * @depends testGameService
     * @param GameService $gameService
     */
    public function testResult(GameService $gameService): void
    {
        $gameService->setNumberGames(1000);
        foreach ($gameService->getPlayers() as $player) {
            $player->setType(GameServiceInterface::TYPE_PAPER);
        }
        $gameService->run();
        $this->assertEquals("Player1: wins - 0, lose - 0, draw - 1000 \nPlayer2: wins - 0, lose - 0, draw - 1000 \n",
            $gameService->result());
    }
}
