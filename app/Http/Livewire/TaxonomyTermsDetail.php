<?php

namespace App\Http\Livewire;

use App\Models\Term;
use Livewire\Component;
use App\Models\Taxonomy;
use Illuminate\View\View;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TaxonomyTermsDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public Taxonomy $taxonomy;
    public Term $term;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Term';

    protected $rules = [
        'term.title' => ['required', 'max:255', 'string'],
        'term.slug' => ['nullable', 'max:255', 'string'],
    ];

    public function mount(Taxonomy $taxonomy): void
    {
        $this->taxonomy = $taxonomy;
        $this->resetTermData();
    }

    public function resetTermData(): void
    {
        $this->term = new Term();

        $this->dispatchBrowserEvent('refresh');
    }

    public function newTerm(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.taxonomy_terms.new_title');
        $this->resetTermData();

        $this->showModal();
    }

    public function editTerm(Term $term): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.taxonomy_terms.edit_title');
        $this->term = $term;

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

        if (!$this->term->taxonomy_id) {
            $this->authorize('create', Term::class);

            $this->term->taxonomy_id = $this->taxonomy->id;
        } else {
            $this->authorize('update', $this->term);
        }

        $this->term->save();

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', Term::class);

        Term::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetTermData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->taxonomy->terms as $term) {
            array_push($this->selected, $term->id);
        }
    }

    public function render(): View
    {
        return view('livewire.taxonomy-terms-detail', [
            'terms' => $this->taxonomy->terms()->paginate(20),
        ]);
    }
}
