<?php

declare(strict_types=1);

namespace App\Reports\ValueObjects;

use Illuminate\Support\Carbon;

class DateString
{
    public function __construct(private string $date)
    {
    }

    public static function fromCarbon(Carbon $timestamp): self
    {
        return new self($timestamp->format('yy-m-d'));
    }

    public static function now(): self
    {
        return new self(Carbon::now()->format('yy-m-d'));
    }

    public function toString(): string
    {
        return $this->date;
    }

    public function __toString(): string
    {
        return $this->toString();
    }
}
