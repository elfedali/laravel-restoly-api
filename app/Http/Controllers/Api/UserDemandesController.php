<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DemandeResource;
use App\Http\Resources\DemandeCollection;

class UserDemandesController extends Controller
{
    public function index(Request $request, User $user): DemandeCollection
    {
        $this->authorize('view', $user);

        $search = $request->get('search', '');

        $demandes = $user
            ->demandes()
            ->search($search)
            ->latest()
            ->paginate();

        return new DemandeCollection($demandes);
    }

    public function store(Request $request, User $user): DemandeResource
    {
        $this->authorize('create', Demande::class);

        $validated = $request->validate([
            'demandeable_id' => ['required', 'max:255'],
            'demandeable_type' => ['required', 'max:255', 'string'],
        ]);

        $demande = $user->demandes()->create($validated);

        return new DemandeResource($demande);
    }
}
