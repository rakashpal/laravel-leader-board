<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Category;
class LeaderBoardController extends Controller
{
    private $user;
    private $category;

    public function __construct(User $user,Category $category){
        $this->user=$user;
        $this->category=$category;
    }

    public function index(){
       
        $categories=$this->category->getCategories();
      //  dd($categories);
        return view('leaderboard',compact('categories'));
    }

    public function topTenUsers(Request $request){
        try{
        $request->validate([
            'category_id'=>'required|exists:category,category_id'
        ]);
        }catch(\Illuminate\Validation\ValidationException $e){
            return response()->json(['status'=>0,'data'=>$e->getMessage()]);
        }

       // $category=$this->category->getById($request->category_id);
        $category=$this->category->getTopTen($request->category_id);
      
        $str= view('user_list',compact('category'))->render();
        return response()->json(['status'=>1,'data'=> $str]);
    }
}
