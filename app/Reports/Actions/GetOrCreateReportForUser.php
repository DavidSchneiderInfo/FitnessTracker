<?php

declare(strict_types=1);

namespace App\Reports\Actions;

use App\Models\DailyReport;
use App\Reports\DTOs\GetOrCreateReport;

class GetOrCreateReportForUser
{
    public function execute(GetOrCreateReport $dto): DailyReport
    {
        /** @var DailyReport $report */
        $report = $dto->user->reports()->firstOrCreate([
            'date' => $dto->date->toString(),
        ]);

        return $report;
    }
}
