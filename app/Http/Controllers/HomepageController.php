<?php

namespace App\Http\Controllers;

use App\City;
use App\Contents;
use App\Post;
use App\Products;
use App\HPContactUS;
use App\Newsletter;
use App\Partners;
use App\Restaurant;
use App\RestaurantCategory;
use App\RestaurantCity;
use App\User;
use App\UserResaurant;
use App\UserRide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Mail;
use Cookie;

class HomepageController extends Controller
{
    public function index(){
        $slider = Contents::where("type","slider")->get();
        $join_us = Contents::where("type","join_us")->first();
        $video = Contents::where("type","video")->first();
        return view("index",compact('slider','join_us','video'));
    }

    public function post($id= null, $name = null){
        $item = Post::where("id",$id)->where("name",$name)->first();
        if($item == null){
            return redirect()->route('index');
        }
        return view('post',compact('item'));
    }

    public function restaurant(){
        $city_id = City::get();
        $category_id = City::get();
        return view('restaurant',compact('city_id','category_id'));
    }

    public function restaurant_post(Request $request){
        $validation = Validator::make($request->all(), $this->rules_restaurant_post());
        if ($validation->fails()) {
            return response()->json(['errors' => $validation->errors()]);
        } else {

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role = 4;
            $user->active = 1;
            if ($request->password != null) {
                $user->password = bcrypt($request->password);
            }
            $user->avatar = 'upload/avatar/no.png';
            $user->save();

            $Post = new Restaurant();
            $Post->name = $request->store_name;
            $Post->fees = 1;
            $Post->avatar = "upload/avatar/no.png";
            $Post->user_id = $user->id;
            $Post->status = 1;
            $Post->active = 1;
            $Post->save();

            $sa = new RestaurantCity();
            $sa->restaurant_id = $Post->id;
            $sa->city_id = $request->city_id;
            $sa->save();

            $sa = new RestaurantCategory();
            $sa->restaurant_id = $Post->id;
            $sa->category_id = $request->category_id;
            $sa->save();

           // Auth::loginUsingId($user->id);

            return response()->json(['success'=>'The account has been opened. You will be contacted']);

        }
    }

    private function rules_restaurant_post()
    {
        $x = [
            'name' => 'required|min:1|max:191',
            'website' => 'required|min:1|max:191',
            'address' => 'required|min:1|max:191',
            'store_name' => 'required|min:1|max:191',
            'city_id' => 'required|min:1|max:191',
            'phone' => 'required|min:1|numeric',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ];
        return $x;
    }

    public function rider(){
        $city_id = City::get();
        return view('rider',compact('city_id'));
    }

    public function rider_post(Request $request){
        $validation = Validator::make($request->all(), $this->rules_rider_post());
        if ($validation->fails()) {
            return response()->json(['errors' => $validation->errors()]);
        } else {

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role = 3;
            $user->active = 1;
            if ($request->password != null) {
                $user->password = bcrypt($request->password);
            }
            $user->avatar = 'upload/avatar/no.png';
            $user->save();

            $user1 = new UserRide();
            $user1->license = $request->license;
            $user1->city_id = $request->city_id;
            $user1->user_id = $user->id;
            $user1->save();

            //Auth::loginUsingId($user->id);

            return response()->json(['success'=>'The account has been opened. You will be contacted']);

        }
    }

    private function rules_rider_post()
    {
        $x = [
            'name' => 'required|min:1|max:191',
            'license' => 'required|min:1|numeric',
            'city_id' => 'required|min:1|max:191',
            'phone' => 'required|min:1|numeric',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ];
        return $x;
    }
    
    public function login_ajax(Request $request){
        $validation = Validator::make($request->all(), $this->login_ajax1());
        if ($validation->fails()) {
            return response()->json(['errors' => $validation->errors()]);
        } else {

            $credentials = array(
                'email' => $request->get('email'),
                'password' => $request->get('password'),
            );
            if (Auth::attempt($credentials, $request->filled('remember'))) {
                $user = Auth::user();
                if ($user->active == 1) {
                    if($user->role == 4){
                        return response()->json(['success'=>'Login Successfully','redirect'=>route('home')]);
                    }else {
                        Auth::logout();
                        return response()->json(['error'=>'Login Failed']);
                    }
                }
                else {
                    Auth::logout();
                    return response()->json(['error'=>'Login Failed']);
                }
            } else {
                return response()->json(['error'=>'Login Failed']);
            }


        }
    }

    private function login_ajax1()
    {
        $x = [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ];
        return $x;
    }
}
