<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use App\Message\AbstractMessage;
use App\Message\Keys\JobKeyAMessage;
use App\Message\Keys\JobKeyBMessage;
use App\RoutingKeysDirect;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Transport\AmqpExt\AmqpStamp;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/key")
 * Class LuckyController
 * @package App\Controller
 */
class SendMessageWithKeyController extends AbstractController
{

    private function sendMessagesAndGenerateResponse($bus, AbstractMessage $message, $routingKey)
    {
        $bus->dispatch($message, [new AmqpStamp($routingKey)]);
        return new Response('===========> SEND - ' . $message->getContent());
    }


    /**
     * @Route("/keyA", methods={"GET","HEAD"})
     */
    public function sendJobKeyA(MessageBusInterface $bus)
    {
        $routingKey = RoutingKeysDirect::JOB_A;
        $messageText = sprintf('Send message with key [%s]', $routingKey);
        $message = new JobKeyAMessage($messageText);

        return $this->sendMessagesAndGenerateResponse($bus, $message, $routingKey);
    }


    /**
     * @Route("/keyB", methods={"GET","HEAD"})
     */
    public function sendJobKeyB(MessageBusInterface $bus)
    {
        $routingKey = RoutingKeysDirect::JOB_B;
        $messageText = sprintf('Send message with key [%s]', $routingKey);
        $message = new JobKeyBMessage($messageText);

        return $this->sendMessagesAndGenerateResponse($bus, $message, $routingKey);
    }


}