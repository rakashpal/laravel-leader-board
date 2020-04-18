<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table='category';
    protected $primaryKey = 'category_id';

    protected $fillable=['category_title','status'];

    public function users(){
    return $this->belongsToMany('App\User','score','category_id','user_id')->withPivot('score','status');
    }

    public function scores(){
        return $this->hasMany('App\Score','category_id','category_id');
        }

    public function getCategories(){
        return self::where('status',1)->get();
    }

    public function getById($category_id){
        return self::where('category_id',$category_id)
       ->with(['users'=>function($q){
           $q->orderBy('pivot_score','desc')->orderBy('name')->limit(10);
       }])
        ->first();
    }

    public function getTopTen($category_id){

        return self::where('category_id',$category_id)
        ->with(['scores'=>function($q){
            $q->select('user_id','category_id',\DB::raw('max(score) as score1'))->groupBy('user_id')->orderBy(\DB::raw('score1'),'desc')->with('user')->limit(10)->get();
        }])
         ->first();
      
       
}
}