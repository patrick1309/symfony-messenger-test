<?php 

namespace App\Repository;

use App\Entity\FailedJob;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Transport\Receiver\ListableReceiverInterface;

class FailedJobRepository
{
    public function __construct(private ListableReceiverInterface $receiver)
    {
        
    }

    public function find(string $id): FailedJob
    {
        return new FailedJob($this->receiver->find($id));
    }

    /**
     * @return FailedJob[]
     */
    public function findAll()
    {
        return array_map(fn (Envelope $envelope) => new FailedJob($envelope), iterator_to_array($this->receiver->all()));
    }

    public function reject(string $id)
    {
        $this->receiver->reject($this->receiver->find($id));
    }
}