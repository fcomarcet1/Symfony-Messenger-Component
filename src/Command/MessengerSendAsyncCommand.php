<?php

namespace App\Command;

use App\Messenger\Message\DefaultAsyncMessage;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\Bridge\Amqp\Transport\AmqpStamp;

class MessengerSendAsyncCommand extends Command
{
    protected static $defaultName = 'app:messenger:send-async';
    protected static $defaultDescription = 'Sends async messages';
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
        // send message
        $this->bus->dispatch(
            new DefaultAsyncMessage('Default async message data'),
            [new AmqpStamp('default_queue')]
        );

        return Command::SUCCESS;
    }
}
