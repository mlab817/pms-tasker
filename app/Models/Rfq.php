<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Rfq extends Model
{
	use HasFactory;

	protected $fillable = [
		'name'
	];

	public function procurement_requests(): BelongsToMany
	{
		return $this->belongsToMany(ProcurementRequest::class);
	}
}
