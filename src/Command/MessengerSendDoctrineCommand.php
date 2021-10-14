<?php

namespace App\Command;

use App\Messenger\Message\DoctrineMessage;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Console\Output\OutputInterface;


class MessengerSendDoctrineCommand extends Command
{
    protected static $defaultName = 'app:messenger:send-doctrine';
    protected static $defaultDescription = 'Sends doctrine messages';
    private MessageBusInterface $bus;

    public function __construct(MessageBusInterface $bus)
    {
        $this->bus = $bus;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setName(self::$defaultName)
            ->setDescription(self::$defaultDescription)
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $start = \microtime(true);
        for ($i=0; $i <= 1;) { 
            $this->bus->dispatch(new DoctrineMessage(\sprintf('Data for doctrine message %s', $i)));
            ++$i;
        }   
        $end = \microtime(true);
        $output->writeln(\sprintf('Total time: %s seg', ($end-$start)));

        return Command::SUCCESS;
    }
}
