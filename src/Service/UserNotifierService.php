<?php 

namespace App\Service;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Twig\Environment;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;

class UserNotifierService
{
    public function __construct(private MailerInterface $mailer, private Environment $twig, private EntityManagerInterface $em, private AsyncMethodService $asyncMethodService)
    {
    }

    public function notify(string $userId)
    {
        $user = $this->em->find(User::class, $userId);
        $email = (new Email())
            ->from('noreply@site.fr')
            ->to($user->getEmail())
            ->html($this->twig->render('email/notification.html.twig', ['user' => $user]));
        //throw new \Exception('Impossible d\'envoyer');
        $this->asyncMethodService->async(MailerInterface::class, 'send', [$email]);
    }
}