<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Restaurant;

class HomeController extends Controller
{
    public function index() {

        $restaurant = Restaurant::all();

        $data = [
            'restaurant' => $restaurant,
        ];

        return view('admin.home', $data);
    }

}
