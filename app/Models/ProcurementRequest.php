<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ProcurementRequest extends Model
{
    use HasFactory;

    public function request_type(): BelongsTo
    {
    	return $this->belongsTo(RequestType::class);
    }

    public function tasks(): BelongsToMany
    {
    	return $this->belongsToMany(Task::class);
    }
}
