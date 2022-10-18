<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public const STATUS_TO_DO = 'to_do';
    public const STATUS_IN_PROCESS = 'in_process';
    public const STATUS_TEST = 'test';
    public const STATUS_DONE = 'done';

    public static array $availableStatuses = [
        self::STATUS_TO_DO => 'К выполнению',
        self::STATUS_IN_PROCESS => 'В процессе',
        self::STATUS_TEST => 'Тестирование',
        self::STATUS_DONE => 'Готово',
    ];

    protected $fillable = [
        'name', 'deadline', 'description',
        'status', 'user_id',
    ];

    protected $casts = [
        'deadline' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public static function getTableName(): string
    {
        return with(new static)->getTable();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function history(): HasMany
    {
        return $this->hasMany(TaskHistory::class);
    }
}
