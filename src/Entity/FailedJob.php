<?php 

namespace App\Entity;

use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Stamp\ErrorDetailsStamp;
use Symfony\Component\Messenger\Stamp\TransportMessageIdStamp;

class FailedJob 
{
    public function __construct(private Envelope $envelope)
    {
        
    }

    public function getMessage(): object
    {
        return $this->envelope->getMessage();
    }

    public function getId(): string 
    {
        /** @var TransportMessageIdStamp[] $stamps */
        $stamps = $this->envelope->all(TransportMessageIdStamp::class);
        return end($stamps)->getId();
    }

    public function getTitle(): string
    {
        return get_class($this->envelope->getMessage());
    }

    public function getTrace(): string
    {
        /** @var RedeliveryStamp[] $stamps */
        $stamps = $this->envelope->all(ErrorDetailsStamp::class);
        return $stamps[0]->getFlattenException()->getTraceAsString();
    }
}