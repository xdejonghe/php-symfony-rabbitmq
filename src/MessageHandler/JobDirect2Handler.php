<?php
namespace App\MessageHandler;

use App\Message\Direct\JobDirect2Message;
use Psr\Log\LoggerInterface;

/**
 * Used to receive a message.
 * @package App\MessageHandler
 */
class JobDirect2Handler extends AbstractHandler
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function __invoke(JobDirect2Message $message)
    {
        parent::logMessage($message);
    }
}