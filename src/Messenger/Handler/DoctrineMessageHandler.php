<?php

declare(strict_types=1);

namespace App\Messenger\Handler;

class DoctrineMessageHandler implements MessageHandlerInterface
{

    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function __invoke(SyncMessage $message): void
    {
        $this->logger->info(\sprintf('DoctrineMessage received. Content: %s', $message->getData()));
    }


}
