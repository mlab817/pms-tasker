<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasModifier {

	public function creator(): BelongsTo
	{
		return $this->belongsTo(User::class, 'created_by', 'id');
	}

	public function updater(): BelongsTo
	{
		return $this->belongsTo(User::class, 'updated_by', 'id');
	}

	public function deleter(): BelongsTo
	{
		return $this->belongsTo(User::class, 'deleted_by', 'id');
	}
}