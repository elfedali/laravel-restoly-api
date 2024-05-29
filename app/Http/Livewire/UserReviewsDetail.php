<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Review;
use Livewire\Component;
use Illuminate\View\View;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserReviewsDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public User $user;
    public Review $review;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Review';

    protected $rules = [
        'review.reviewable_id' => ['required', 'max:255'],
        'review.reviewable_type' => ['required', 'max:255', 'string'],
        'review.content' => ['required', 'max:255', 'string'],
        'review.rating' => ['nullable', 'max:255'],
    ];

    public function mount(User $user): void
    {
        $this->user = $user;
        $this->resetReviewData();
    }

    public function resetReviewData(): void
    {
        $this->review = new Review();

        $this->dispatchBrowserEvent('refresh');
    }

    public function newReview(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.user_reviews.new_title');
        $this->resetReviewData();

        $this->showModal();
    }

    public function editReview(Review $review): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.user_reviews.edit_title');
        $this->review = $review;

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

        if (!$this->review->user_id) {
            $this->authorize('create', Review::class);

            $this->review->user_id = $this->user->id;
        } else {
            $this->authorize('update', $this->review);
        }

        $this->review->save();

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', Review::class);

        Review::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetReviewData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->user->reviews as $review) {
            array_push($this->selected, $review->id);
        }
    }

    public function render(): View
    {
        return view('livewire.user-reviews-detail', [
            'reviews' => $this->user->reviews()->paginate(20),
        ]);
    }
}
