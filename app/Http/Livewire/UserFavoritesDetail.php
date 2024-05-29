<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\Favorite;
use Illuminate\View\View;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserFavoritesDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public User $user;
    public Favorite $favorite;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Favorite';

    protected $rules = [
        'favorite.favoritable_id' => ['required', 'max:255'],
        'favorite.favoritable_type' => ['required', 'max:255', 'string'],
    ];

    public function mount(User $user): void
    {
        $this->user = $user;
        $this->resetFavoriteData();
    }

    public function resetFavoriteData(): void
    {
        $this->favorite = new Favorite();

        $this->dispatchBrowserEvent('refresh');
    }

    public function newFavorite(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.user_favorites.new_title');
        $this->resetFavoriteData();

        $this->showModal();
    }

    public function editFavorite(Favorite $favorite): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.user_favorites.edit_title');
        $this->favorite = $favorite;

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

        if (!$this->favorite->user_id) {
            $this->authorize('create', Favorite::class);

            $this->favorite->user_id = $this->user->id;
        } else {
            $this->authorize('update', $this->favorite);
        }

        $this->favorite->save();

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', Favorite::class);

        Favorite::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetFavoriteData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->user->favorites as $favorite) {
            array_push($this->selected, $favorite->id);
        }
    }

    public function render(): View
    {
        return view('livewire.user-favorites-detail', [
            'favorites' => $this->user->favorites()->paginate(20),
        ]);
    }
}
