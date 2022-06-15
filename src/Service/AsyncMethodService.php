<?php 

namespace App\Service;

use App\Message\ServiceMethodCallMessage;
use Symfony\Component\Messenger\MessageBusInterface;

class AsyncMethodService
{
    public function __construct(private MessageBusInterface $messageBus)
    {
        
    }

    public function async(string $serviceName, string $methodName, array $params = [])
    {
        $this->messageBus->dispatch(new ServiceMethodCallMessage(
            $serviceName, 
            $methodName, 
            $params
        ));
    }
}