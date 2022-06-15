<?php

namespace App\EventSubscriber;

use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Messenger\Event\WorkerMessageFailedEvent;

class FailedMessageSubscriber implements EventSubscriberInterface
{
    public function __construct(private MailerInterface $mailer)
    {
        
    }

    public function onWorkerMessageFailedEvent(WorkerMessageFailedEvent $event): void
    {
        $message = get_class($event->getEnvelope()->getMessage());
        $trace = $event->getThrowable()->getTraceAsString();
        $email = (new Email())
            ->from('noreply@site.fr')
            ->to('admin@admin.com')
            ->text(<<<TEXT
Une erreur est survenue

{$message}

{$trace}
TEXT);

        $this->mailer->send($email);
    }

    public static function getSubscribedEvents(): array
    {
        return [
            WorkerMessageFailedEvent::class => 'onWorkerMessageFailedEvent',
        ];
    }
}
