<?php

namespace Database\Factories;

use App\Models\DailyReport;
use App\Models\User;
use App\Reports\ValueObjects\DateString;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Support\Carbon;

/**
 * @extends Factory<DailyReport>
 */
class DailyReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date' => DateString::now()->toString(),
            'consumption' => 0,
            'depletion' => 0,
        ];
    }

    public function forUser(User $user): self
    {
        return $this->state([
            'user_id' => $user->id,
        ]);
    }

    public function withDaysOfReports(int $days): self
    {
        $sequences = collect();

        for ($x = 0; $x < $days; $x++) {
            $sequences->add([
                'date' => Carbon::now()->subDays($x),
            ]);
        }

        return $this->count($days)->state(new Sequence($sequences->toArray()));
    }
}
