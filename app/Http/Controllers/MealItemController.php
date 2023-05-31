<?php

namespace App\Http\Controllers;

use App\Models\MealItem;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MealItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MealItem  $mealItem
     * @return \Illuminate\Http\Response
     */
    public function show(MealItem $mealItem)
    {
        return Inertia::render('MealItem/Show', [
            'meal_item' => $mealItem->loadMissing('meal', 'macros')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MealItem  $mealItem
     * @return \Illuminate\Http\Response
     */
    public function edit(MealItem $mealItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MealItem  $mealItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MealItem $mealItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MealItem  $mealItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(MealItem $mealItem)
    {
        //
    }
}