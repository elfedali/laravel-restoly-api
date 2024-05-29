<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Activity;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ActivityStoreRequest;
use App\Http\Requests\ActivityUpdateRequest;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Activity::class);

        $search = $request->get('search', '');

        $activities = Activity::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.activities.index', compact('activities', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Activity::class);

        $users = User::pluck('name', 'id');

        return view('app.activities.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ActivityStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Activity::class);

        $validated = $request->validated();

        $activity = Activity::create($validated);

        return redirect()
            ->route('activities.edit', $activity)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Activity $activity): View
    {
        $this->authorize('view', $activity);

        return view('app.activities.show', compact('activity'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Activity $activity): View
    {
        $this->authorize('update', $activity);

        $users = User::pluck('name', 'id');

        return view('app.activities.edit', compact('activity', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ActivityUpdateRequest $request,
        Activity $activity
    ): RedirectResponse {
        $this->authorize('update', $activity);

        $validated = $request->validated();

        $activity->update($validated);

        return redirect()
            ->route('activities.edit', $activity)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Activity $activity
    ): RedirectResponse {
        $this->authorize('delete', $activity);

        $activity->delete();

        return redirect()
            ->route('activities.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
