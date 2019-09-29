<?php
declare(strict_types=1);


namespace App\Symfony\Command;

use App\Blog\Domain\Shared\Infrastructure\Event;
use App\Blog\Domain\User\Events\UserWasCreatedEvent;
use App\Blog\Infrastructure\Shared\Rabbitmq\RabbitmqClient;
use PhpAmqpLib\Message\AMQPMessage;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

final class ConfirmationEmailSenderWorker extends Command
{
    protected static $defaultName = 'app:confirm-user-email';

    private $client;

    private $logger;

    private $mailer;

    public function __construct(
        RabbitmqClient $client,
        LoggerInterface $logger,
        \Swift_Mailer $mailer
    )
    {
        parent::__construct();
        $this->client = $client;
        $this->logger = $logger;
        $this->mailer = $mailer;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $this->client->queue(UserWasCreatedEvent::class);
        $io->write("[*] Waiting for messages. To exit press CTRL+C\n");
        $this->client->consume(UserWasCreatedEvent::class, function (AMQPMessage $msg) {
            $event = unserialize($msg->getBody());

            if (false === ($event instanceof Event))
            {
                $this->logger->error(sprintf('Is not a Event %s', $msg->getBody()));

                return;
            }
            $message = (new \Swift_Message('Hello Email'))
                ->setFrom('confirm@cqrs-blog.local')
                ->setTo('recipient@example.com')
                ->setBody('test');
            $this->mailer->send($message);
            $this->logger->info('Email sended');
        });

        while ($this->client->is_consuming())
        {
            $this->client->wait();
        }
    }
}