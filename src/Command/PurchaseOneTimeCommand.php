<?php

namespace App\Command;

use App\Dto\PurchaseOneTimeRequestDto;
use App\Service\PurchaseOneTimeService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:purchase-one-time',
    description: 'Add a short description for your command',
)]
class PurchaseOneTimeCommand extends Command
{
    public function __construct(
        private PurchaseOneTimeService $purchaseOneTimeService,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('externalSystem', InputArgument::REQUIRED, 'The external system to purhcase');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $externalSystem = $input->getArgument('externalSystem');

        $purchaseOneTimeRequestDto = new PurchaseOneTimeRequestDto(
            amount: 499,
            currency: 'USD',
            cardNumber: '4242424242424242',
            cardExpiryYear: 2025,
            cardExpiryMonth: 12,
            cardCvv: '999',
        );

        $this->purchaseOneTimeService->purchaseOneTime($externalSystem, $purchaseOneTimeRequestDto);

        $io->success("The amount {$purchaseOneTimeRequestDto->amount} has been charged using {$externalSystem} successfully!");

        return Command::SUCCESS;
    }
}
