<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\UserModel;

class AuthenController extends Controller {

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */
    public function index(Request $request) {

        if ($request->session()->has('id')) {

            return redirect('/dashboard');
        } else {
     return redirect('/login');
        }
    }

    public function authen(Request $request){

       
        if($request->session()->has('id')){

            return redirect('/');

        }else{

            return view('auth_v');

        }
    }

   
    public function checkAuth(Request $request){


         if($result =  UserModel::CheckUser($request->input('username'),$request->input('password'))){

             

             if($result!='ไม่ผ่าน'){

            $request->session()->put('id',$result->id);
            $request->session()->put('em_id',$result->em_id);
            $request->session()->put('customer_id',$result->customer_id);
            $request->session()->put('status',$result->status);
            $request->session()->put('work_status',$result->work_status);
            $request->session()->put('img',$result->img);

             return redirect('/');

           

             }  else {

                 

                 return redirect('/');

                 

             }

 

               

        }

    }

    public function logout(){

        

         $data = session()->flush();

         

         return redirect('/');

    }

    

}
