<?php

namespace App\Livewire;

use Livewire\Attributes\Reactive;
use Livewire\Component;

class SearchResults extends Component
{

    #[Reactive]
    public $results = [];

    #[Reactive]
    public bool $show;

    public function render()
    {
        return view('livewire.search-results');
    }
}
