<?php

use App\Models\User;
use App\Models\Category;
use App\Models\Vehicle;
function totalCars()
{
    $cars =Vehicle::count();
   
    return $cars;
}
function totalCategories()
{
    $category =Category::count();
   
    return $category;
}
function totalUsers()
{
    $users =User::count();
   
    return $users;
}