<?php

declare(strict_types=1);

namespace App\Symfony\Command;

use App\Blog\Domain\Shared\Infrastructure\Event;
use App\Blog\Infrastructure\Shared\Processor\SyncProjectionProcessor;
use App\Blog\Infrastructure\Shared\Rabbitmq\RabbitmqClient;
use PhpAmqpLib\Message\AMQPMessage;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

final class ProjectionWorker extends Command
{
    protected static $defaultName = 'app:create-projection';

    private $client;

    private $projectionProcessor;

    private $logger;

    public function __construct(
        RabbitmqClient $client,
        SyncProjectionProcessor $projectionProcessor,
        LoggerInterface $logger
    ) {
        parent::__construct();
        $this->client = $client;
        $this->projectionProcessor = $projectionProcessor;
        $this->logger = $logger;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $this->client->queue('projection');
        $io->write("[*] Waiting for messages. To exit press CTRL+C\n");
        $this->client->consume('projection', function (AMQPMessage $msg) {
            $event = unserialize($msg->getBody(), ['allowed_classes' => AMQPMessage::class]);

            if (false === ($event instanceof Event)) {
                $this->logger->error(sprintf('Is not a Event %s', $msg->getBody()));

                return;
            }
            $this->projectionProcessor->process($event);
        });

        while ($this->client->is_consuming()) {
            $this->client->wait();
        }
    }
}
