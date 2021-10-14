<?php

declare(strict_types=1);

namespace App\Messenger\Handler;

use Psr\Log\LoggerInterface;
use App\Messenger\Message\DoctrineMessage;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class DoctrineMessageHandler implements MessageHandlerInterface
{

    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function __invoke(DoctrineMessage $message): void
    {
        //throw new \Exception('Something went wrong');
        $this->logger->info(\sprintf('DoctrineMessage received. Content: %s', $message->getData()));
    }


}
