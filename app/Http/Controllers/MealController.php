<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMealRequest;
use App\Models\Meal;
use App\Models\MealItem;
use App\Models\Macro;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class MealController extends Controller
{
    protected const DEFAULT_PAGE_SIZE = 10;

    protected function getPageSize(int $requestPageSize)
    {
        if ($requestPageSize != 0) {
            return min($requestPageSize, 50); //limit custom page size to 50
        } else {
            return self::DEFAULT_PAGE_SIZE;
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $showAll = $request->boolean('show_all');
        $pageSize = $this->getPageSize($request->integer('page_size'));
        $meals = Meal::with('user:id,name')
            ->where('user_id', auth()->user()->id)
            ->when($showAll, function ($query) {
                return $query->orWhere('public', true);
            })
            ->orderBy('consumed_at', 'desc')
            ->paginate($pageSize);
        $meals->getCollection()->transform(function ($meal) {
            return $meal->withMacroSummary();
        });

        //Use page_size param for non-default page size
        if ($pageSize != self::DEFAULT_PAGE_SIZE) {
            $meals->appends('page_size', $pageSize);
        }

        return Inertia::render('Meals/Index', [
            'meals' => $meals,
            'showAllMeals' => $showAll
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Meals/Create', [
            'user_id' => Auth::id(),
            'macroList'=> Macro::TYPES
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMealRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMealRequest $request)
    {

        $validated = $request->validated();
        //Let cabon handle date
        $validated['consumed_at'] = new Carbon($validated['consumed_at']);

        // dd($validated);
        DB::beginTransaction();
        try {

            $meal = new Meal($validated);
            Auth::user()->meals()->save($meal);

            foreach ($validated['meal_items'] as $meal_item) {
                $meal_item_obj = new MealItem($meal_item);
                $meal->mealItems()->save($meal_item_obj);

                foreach ($meal_item['macros'] as $macro) {
                    $macro_obj = new Macro($macro);
                    $meal_item_obj->macros()->save($macro_obj);
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error occured when trying to create a new meal: ' . $e->getMessage());
        }

        return redirect(route('meals.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Meal  $meal
     * @return \Illuminate\Http\Response
     */
    public function show(Meal $meal)
    {
        $this->authorize('view', $meal);

        return Inertia::render('Meals/Show', [
            'meal' => $meal->loadMissing('mealItems.macros')->loadMissing('user')->withMacroSummary(true)
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
