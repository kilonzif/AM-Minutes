<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;


class Minute extends Model
{

    use SoftDeletes;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'meeting_title', 'purpose', 'organization','start_date', 'end_date', 'meeting_notes'
    ];
    protected $table = 'minutes';



}
