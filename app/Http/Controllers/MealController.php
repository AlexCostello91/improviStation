<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;


class MealController extends Controller
{
    protected int $defaultPageSize = 10;

    protected function getPageSize(int $requestPageSize){
        if($requestPageSize != 0){
            return min($requestPageSize, 50);
        } else {
            return $this->defaultPageSize;
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $pageSize = $this->getPageSize($request->integer('page_size'));
        $meals = Meal::with('user:id,name')
            ->where('public', true)
            ->orWhere('user_id', auth()->user()->id)
            ->latest()
            ->paginate($pageSize);

        //Use page_size param for non-default page size
        if($pageSize!=$this->defaultPageSize){
            $meals->appends('page_size', $pageSize);
        }

        return Inertia::render('Meals/Index', [
            'meals' => $meals
        ]);
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
     * @param  \App\Models\Meal  $meal
     * @return \Illuminate\Http\Response
     */
    public function show(Meal $meal)
    {
        return Inertia::render('Meals/Show', [
            'meal' => $meal->loadMissing('mealItems.macros')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Meal  $meal
     * @return \Illuminate\Http\Response
     */
    public function edit(Meal $meal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Meal  $meal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Meal $meal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Meal  $meal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Meal $meal)
    {
        //
    }
}
