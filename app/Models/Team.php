<?php

namespace App\Models;

use Mpociot\Teamwork\TeamworkTeam;

class Team extends TeamworkTeam
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'owner_id',
    ];
}
