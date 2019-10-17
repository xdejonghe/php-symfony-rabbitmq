<?php
namespace App\MessageHandler;

use App\Message\Keys\JobKeyBMessage;
use Psr\Log\LoggerInterface;

/**
 * Used to receive a message.
 * @package App\MessageHandler
 */
class JobKey2Handler extends AbstractHandler
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function __invoke(JobKeyBMessage $message)
    {
        parent::logMessage($message);
    }
}