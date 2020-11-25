<?php

namespace App\Models;

use App\Traits\HasModifier;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Mpociot\Teamwork\Traits\UsedByTeams;

class Task extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasModifier;
    use Searchable;
    use UsedByTeams;

    protected $fillable = [
		'action_id', // action required
	    'other_actions',
		'user_id', // staff assigned
		'completed', //if completed or not
		'details', // details of the assignment
		'remarks', // any other details
		'status_id', // current status of the task
		'completed_at', //
		'created_by',
    ];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
    public function procurement_requests(): BelongsToMany
    {
    	return $this->belongsToMany(ProcurementRequest::class);
    }

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
    public function enduser(): BelongsTo
    {
        return $this->belongsTo(Enduser::class);
    }

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getCompletedAttribute(): bool
    {
    	return (bool) $this->completed_at;
    }

    public function scopeOwn($query)
    {
    	$user = auth()->user()->staff_id;

    	if (! $user) {
    		return $query;
	    }

    	return $query->where('staff_id', $user);
    }

    public function toSearchableArray()
    {
		$array = $this->toArray();

		return $array;
    }
}
