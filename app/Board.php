<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Board extends Model
{
    use SoftDeletes;

    protected $table = 'hanjae_board';
    protected $fillable = [
        'comment','writer','title','board_date','board_view'
    ];
    protected $dates = ['board_date'];

}
