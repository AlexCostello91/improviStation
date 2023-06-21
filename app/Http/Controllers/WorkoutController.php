<?php

namespace App\Http\Controllers;

use App\Models\Workout;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WorkoutController extends Controller
{
    /**
     * Default Paging Size for Meal collections
     */
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
     * Display list of workouts.
     *
     * @param  Illuminate\Http\Request $request
     * @return void
     */
    public function index(Request $request)
    {
        $pageSize = $this->getPageSize($request->integer('page_size'));
        $workouts = Workout::with('user:id,name')
        ->where('user_id', auth()->user()->id)
            ->orderBy('started_at', 'desc')
            ->paginate($pageSize);
        //Use page_size param for non-default page size
        if ($pageSize != self::DEFAULT_PAGE_SIZE) {
            $workouts->appends('page_size', $pageSize);
        }

        return Inertia::render('Workouts/Index', [
            'workouts' => $workouts
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
     * @param  \App\Models\Workout  $workout
     * @return \Illuminate\Http\Response
     */
    public function show(Workout $workout)
    {
        $this->authorize('view', $workout);

        return Inertia::render('Workouts/Show', [
            'workout' => $workout
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Workout  $workout
     * @return \Illuminate\Http\Response
     */
    public function edit(Workout $workout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Workout  $workout
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Workout $workout)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Workout  $workout
     * @return \Illuminate\Http\Response
     */
    public function destroy(Workout $workout)
    {
        //
    }
}
