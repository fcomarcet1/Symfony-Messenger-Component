<?php

namespace App\Command;

use App\Messenger\Message\SyncMessage;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MessengerSendSyncCommand extends Command
{

    protected static $defaultName = 'app:messenger:send-sync';
    protected static $defaultDescription = 'Sends sync messages';
    private MessageBusInterface $bus;
    
    public function __construct(MessageBusInterface $bus)
    {
        $this->bus = $bus;   
    }


    protected function configure(): void
    {
        $this
            ->setName('app:messenger:send-sync')
            ->setDescription(self::$defaultDescription)
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        for ($i=0; $i <=10;) { 
            $this->bus->dispatch(new SyncMessage(\sprintf('Data for message %s', $i)));
            ++$i;
        }
      
        return Command::SUCCESS;
    }
}
