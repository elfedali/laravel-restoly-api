<?php

namespace App\Http\Controllers\Api;

use App\Models\Demande;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\DemandeResource;
use App\Http\Resources\DemandeCollection;
use App\Http\Requests\DemandeStoreRequest;
use App\Http\Requests\DemandeUpdateRequest;

class DemandeController extends Controller
{
    public function index(Request $request): DemandeCollection
    {
        $this->authorize('view-any', Demande::class);

        $search = $request->get('search', '');

        $demandes = Demande::search($search)
            ->latest()
            ->paginate();

        return new DemandeCollection($demandes);
    }

    public function store(DemandeStoreRequest $request): DemandeResource
    {
        $this->authorize('create', Demande::class);

        $validated = $request->validated();

        $demande = Demande::create($validated);

        return new DemandeResource($demande);
    }

    public function show(Request $request, Demande $demande): DemandeResource
    {
        $this->authorize('view', $demande);

        return new DemandeResource($demande);
    }

    public function update(
        DemandeUpdateRequest $request,
        Demande $demande
    ): DemandeResource {
        $this->authorize('update', $demande);

        $validated = $request->validated();

        $demande->update($validated);

        return new DemandeResource($demande);
    }

    public function destroy(Request $request, Demande $demande): Response
    {
        $this->authorize('delete', $demande);

        $demande->delete();

        return response()->noContent();
    }
}
