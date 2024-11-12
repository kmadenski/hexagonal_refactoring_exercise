<?php
namespace App\Application;

use App\Application\Dto\TransactionDtoFactory;
use App\Application\Port\Driving\CommissionServiceInterface;

class CommissionAdapter
{
    private CommissionServiceInterface $commissionService;

    /**
     * @param CommissionServiceInterface $commissionService
     */
    public function __construct(CommissionServiceInterface $commissionService)
    {
        $this->commissionService = $commissionService;
    }


    public function __invoke($input): void
    {
        foreach (explode("\n", file_get_contents($input)) as $row) {
            if (empty($row)) break;

            $transactionDto = TransactionDtoFactory::create($row);
            $commission = $this->commissionService->handle($transactionDto);

            $amountFixed = $commission->value();

            echo $amountFixed;
            print "\n";
        }
    }

}
