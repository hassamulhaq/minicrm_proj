<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'company_id',
    ];

    protected $keyType = 'string';

    public static function boot() {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = Uuid::uuid4()->toString();
            }
        });
    }
}
