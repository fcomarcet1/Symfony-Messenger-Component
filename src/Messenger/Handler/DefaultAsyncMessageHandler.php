<?php 
declare(strict_types=1);

namespace App\Messenger\Handler;

use Psr\Log\LoggerInterface;
use App\Messenger\Message\DefaultAsyncMessage;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class DefaultAsyncMessageHandler implements MessageHandlerInterface
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function __invoke(DefaultAsyncMessage $message): void
    {
        $this->logger->info(\sprintf('DefaultAsyncMessage received. Content: %s', $message->getData()));
    }

}