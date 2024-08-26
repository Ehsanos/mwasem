<?php

use App\Http\Controllers\SliderController;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\CategoryController;
use  App\Http\Controllers\CityController;
use  App\Http\Controllers\ProductController;




Route::get('/allCats',[CategoryController::class,'index']);//All categories
Route::get('/cat/{id}',[CategoryController::class,'show']);//all Products in category


Route::get('/allCities',[CityController::class,'index']);//All Cities
Route::get('/city/{id}',[CityController::class,'show']);//All products in City



Route::get('/allproducts',[ProductController::class,'index']); //All active Products
Route::get('/product/{id}',[ProductController::class,'show']) ;//show this product;




Route::get('/sliders',[SliderController::class,'index']); //All Active  Sliders


