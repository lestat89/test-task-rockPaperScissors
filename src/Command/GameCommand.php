<?php

namespace App\Command;

use App\Services\GameService\GameServiceInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class GameCommand
 * @package App\Command
 */
class GameCommand extends Command
{
    private GameServiceInterface $gameService;

    /**
     * GameCommand constructor.
     * @param GameServiceInterface $gameService
     */
    public function __construct(GameServiceInterface $gameService)
    {
        $this->gameService = $gameService;

        parent::__construct(null);
    }

    /**
     *
     */
    protected function configure()
    {
        $this->setName('game:run-game')
            ->setDescription('Start game.');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->gameService->setNumberGames(10000000);
        $this->gameService->run();

        $output->writeln($this->gameService->result());

        return 0;
    }
}
