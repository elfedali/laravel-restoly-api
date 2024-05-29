<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\Demande;
use Illuminate\View\View;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserDemandesDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public User $user;
    public Demande $demande;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Demande';

    protected $rules = [
        'demande.demandeable_id' => ['required', 'max:255'],
        'demande.demandeable_type' => ['required', 'max:255', 'string'],
    ];

    public function mount(User $user): void
    {
        $this->user = $user;
        $this->resetDemandeData();
    }

    public function resetDemandeData(): void
    {
        $this->demande = new Demande();

        $this->dispatchBrowserEvent('refresh');
    }

    public function newDemande(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.user_demandes.new_title');
        $this->resetDemandeData();

        $this->showModal();
    }

    public function editDemande(Demande $demande): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.user_demandes.edit_title');
        $this->demande = $demande;

        $this->dispatchBrowserEvent('refresh');

        $this->showModal();
    }

    public function showModal(): void
    {
        $this->resetErrorBag();
        $this->showingModal = true;
    }

    public function hideModal(): void
    {
        $this->showingModal = false;
    }

    public function save(): void
    {
        $this->validate();

        if (!$this->demande->user_id) {
            $this->authorize('create', Demande::class);

            $this->demande->user_id = $this->user->id;
        } else {
            $this->authorize('update', $this->demande);
        }

        $this->demande->save();

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', Demande::class);

        Demande::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetDemandeData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->user->demandes as $demande) {
            array_push($this->selected, $demande->id);
        }
    }

    public function render(): View
    {
        return view('livewire.user-demandes-detail', [
            'demandes' => $this->user->demandes()->paginate(20),
        ]);
    }
}
