<?php
namespace App\MessageHandler;

use App\Message\Keys\JobKeyAMessage;
use Psr\Log\LoggerInterface;

/**
 * Used to receive a message.
 * @package App\MessageHandler
 */
class JobKey1Handler extends AbstractHandler
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function __invoke(JobKeyAMessage $message)
    {
        parent::logMessage($message);
    }
}