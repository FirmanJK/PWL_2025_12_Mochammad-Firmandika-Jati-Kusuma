<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function foodBeverage()
    {
        return view('category.food-beverage');
    }

    public function beautyHealth()
    {
        return view('category.beauty-health');
    }

    public function homeCare()
    {
        return view('category.home-care');
    }

    public function babyKid()
    {
        return view('category.baby-kid');
    }
}