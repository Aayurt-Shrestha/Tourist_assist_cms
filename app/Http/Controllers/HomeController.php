<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Tour;
use App\Category;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $categories = new Category();
        $categories = $categories->orderBy('name', 'ASC')->get();
        $tours = new Tour();
        $tours = $tours->orderBy('views', 'DESC')->get();
        return view('layouts.home',compact('tours','categories'));
    }
    public function user()
    {
        $users = new User;
        $users = $users->get();
        return view('layouts.listUsers',compact('users'));
    }
    public function destroy($id)
    {
        $users = new User;
        $user = $users->find($id);
        $user->delete();
        return redirect(route('userlist'));
    }
}
