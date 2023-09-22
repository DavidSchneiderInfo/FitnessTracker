<?php

declare(strict_types=1);

namespace App\Reports\DTOs;

use App\Models\User;
use App\Reports\ValueObjects\DateString;

class GetOrCreateReport
{
    public function __construct(
        public readonly User $user,
        public readonly DateString $date
    ) {
    }
}
