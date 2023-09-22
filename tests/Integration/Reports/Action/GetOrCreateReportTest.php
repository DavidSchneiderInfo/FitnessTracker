<?php

declare(strict_types=1);

namespace Tests\Integration\Reports\Action;

use App\Models\DailyReport;
use App\Models\User;
use App\Reports\Actions\GetOrCreateReportForUser;
use App\Reports\DTOs\GetOrCreateReport;
use App\Reports\ValueObjects\DateString;
use Tests\TestCase;

class GetOrCreateReportTest extends TestCase
{
    public function testCanCreateANewReport(): void
    {
        /** @var User $user */
        $user = User::factory()->create();

        $date = DateString::now();

        $this->assertNull(DailyReport::query()
            ->where('user_id', $user->id)
            ->where('date', $date)
            ->first()
        );

        /** @var GetOrCreateReportForUser $action */
        $action = $this->app->make(GetOrCreateReportForUser::class);
        $action->execute(
            new GetOrCreateReport(
                $user,
                $date
            )
        );

        $this->assertNotNull(DailyReport::query()
            ->where('user_id', $user->id)
            ->where('date', $date)
            ->first()
        );
    }

    public function testCanGetAnExistingReport(): void
    {
        /** @var User $user */
        $user = User::factory()->create();

        /** @var DailyReport $report */
        $report = DailyReport::factory()->forUser($user)->create([]);
        $expected = $report->toArray();

        /** @var GetOrCreateReportForUser $action */
        $action = $this->app->make(GetOrCreateReportForUser::class);
        $actual = $action->execute(
            new GetOrCreateReport(
                $user,
                new DateString($report->date)
            )
        )->toArray();

        $this->assertEquals($expected, $actual);
    }
}
