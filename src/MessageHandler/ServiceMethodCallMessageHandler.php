<?php

namespace App\MessageHandler;

use Psr\Container\ContainerInterface;
use App\Message\ServiceMethodCallMessage;
use App\Service\UserNotifierService;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Contracts\Service\ServiceSubscriberInterface;

final class ServiceMethodCallMessageHandler implements MessageHandlerInterface, ServiceSubscriberInterface
{
    public function __construct(private ContainerInterface $container)
    {
        
    }

    public function __invoke(ServiceMethodCallMessage $message)
    {
        $callable = [
            $this->container->get($message->getServiceName()),
            $message->getMethodName()
        ];
        call_user_func_array($callable, $message->getParams());
    }

    public static function getSubscribedServices(): array
    {
        return [
            UserNotifierService::class => UserNotifierService::class,
            MailerInterface::class => MailerInterface::class
        ];
    }


}
