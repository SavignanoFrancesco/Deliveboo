<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restaurant;
use App\Dish;
use App\Menu;

class RestaurantController extends Controller
{
    public function show($slug){

        $restaurant = Restaurant::where('slug', $slug)->first();

        if ($restaurant) {

            $menus = Menu::where('restaurant_id', $restaurant->id)->get()->unique('menu_category_id');
            $dishes = $restaurant->dishes;

            return view('guest.restaurant', ['slug'=> $restaurant->slug], compact('restaurant', 'dishes', 'menus'));
        } else {
            abort(404);
        }
    }
}
