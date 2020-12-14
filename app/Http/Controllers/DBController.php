<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Employee;

class DBController extends Controller
{

  public function index(){

    //$emp = DB::table('employee')->select('name','age','city')->get(); //specific column data
    //$emp = DB::table('employee')->pluck('email','city'); //email => city

    //$single = DB::table('employee')->first(); //first row show data
    //$order = DB::table('employee')->orderBy('id','DESC')->get(); // DESC
    //$limit = DB::table('employee')->orderBy('id','DESC')->limit(1)->get(); //orderby desc

    //$count = DB::table('employee')->count();

    //$min = DB::table('employee')->AVG('salary');
    //dd($min);
  }


    public function joining(){
      $result = DB::table('orders')
      ->join('user','user.id', '=','orders.id')
      ->select('user.name','orders.id','orders.amount','orders.order_date')
      ->WHERE ('status', 0)
      ->get();
      dd($result);
    }




    public function model(){

        $result = Employee::all();
        dd($result);

    }


}
