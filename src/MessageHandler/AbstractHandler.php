<?php

namespace App\MessageHandler;

use App\Message\AbstractMessage;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

/**
 * Created by IntelliJ IDEA.
 * User: xavier
 * Date: 2019-10-07
 * Time: 17:47
 */
abstract class AbstractHandler implements MessageHandlerInterface
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function logMessage(AbstractMessage $message)
    {
        $message = sprintf('<======= RECEIVE FROM [%s] MESSAGE [%s]', get_class($this), $message->getContent());
        $this->logger->error($message);
    }
}