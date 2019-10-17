<?php
namespace App\MessageHandler;

use App\Message\Direct\JobDirect1Message;
use Psr\Log\LoggerInterface;

/**
 * Used to receive a message.
 * @package App\MessageHandler
 */
class JobDirect1Handler extends AbstractHandler
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function __invoke(JobDirect1Message $message)
    {
        parent::logMessage($message);
    }
}