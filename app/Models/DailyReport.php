<?php

namespace App\Models;

use Database\Factories\DailyReportFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static DailyReportFactory factory
 *
 * @property int|null $id
 * @property string $date
 */
class DailyReport extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'date',
        'consumption',
        'depletion',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
