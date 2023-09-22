<?php

namespace Database\Seeders;

use App\Models\User;
use App\Reports\Actions\GetOrCreateReportForUser;
use App\Reports\DTOs\GetOrCreateReport;
use App\Reports\ValueObjects\DateString;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /** @var User $user */
        $user = User::query()->firstOrCreate([
            'email' => 'd4vid81@gmail.com',
        ], [
            'name' => 'David Schneider',
            'password' => bcrypt(Str::random()),
            'email_verified_at' => Carbon::now(),
        ]);

        /** @var GetOrCreateReportForUser $action */
        $action = app()->make(GetOrCreateReportForUser::class);

        for ($x = 0; $x < 14; $x++) {
            $action->execute(
                new GetOrCreateReport(
                    $user,
                    DateString::fromCarbon(
                        Carbon::now()->subDays($x)
                    )
                )
            );
        }
    }
}
