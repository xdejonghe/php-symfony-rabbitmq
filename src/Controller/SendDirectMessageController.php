<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use App\Message\AbstractMessage;
use App\Message\Direct\JobDirect;
use App\Message\Direct\JobDirect1Message;
use App\Message\Direct\JobDirect2Message;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/direct")
 * Class LuckyController
 * @package App\Controller
 */
class SendDirectMessageController extends AbstractController
{

    /**
     * @param Request $request
     * @return string
     */
    public function buildMessage(Request $request, string $msg): string
    {
        $messageParameter = $request->query->get('message');
        $messageTxt = $msg . (isset ($messageParameter) ? ' - ' . $messageParameter : '');
        return $messageTxt;
    }

    private function sendMessagesAndGenerateResponse($bus, AbstractMessage $message)
    {
        $bus->dispatch($message);
        return new Response('===========> SEND [' . $message->getContent() . ']');
    }


    /**
     * @Route("/job1", methods={"GET","HEAD"})
     */
    public function executeJob1(MessageBusInterface $bus, Request $request)
    {
        $messageTxt = $this->buildMessage($request, 'execute job1');
        $message = new JobDirect1Message($messageTxt);

        return $this->sendMessagesAndGenerateResponse($bus, $message);
    }

    /**
     * @Route("/job2", methods={"GET","HEAD"})
     */
    public function executeJob2(MessageBusInterface $bus, Request $request)
    {
        $messageTxt = $this->buildMessage($request, 'execute job2');
        $message = new JobDirect2Message($messageTxt);

        return $this->sendMessagesAndGenerateResponse($bus, $message);
    }

    /**
     * @Route("/fanout", methods={"GET","HEAD"})
     */
    public function executeFanout(MessageBusInterface $bus, Request $request)
    {
        $messageTxt = $this->buildMessage($request, 'execute fanout');
        $message = new JobDirect($messageTxt);

        return $this->sendMessagesAndGenerateResponse($bus, $message);
    }


}