<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $table='score';
    protected $primaryKey = 'score_id';

    protected $fillable=['user_id','category_id','score','status'];
    
    public function user(){
        return $this->belongsTo('App\User','user_id','user_id');
        }
}
