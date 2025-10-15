<?php

namespace App\Livewire;

use App\Models\Article;
use Livewire\Attributes\On;
use Livewire\Component;

class ConfirmDelete extends Component
{
    public bool $show = false;
    public Article $article;

    #[On('confirm-delete')]
    public function open(Article $article)
    {
        $this->show = true;
        $this->article = $article;
    }

    public function close()
    {
        $this->reset(['show']);
    }

    #[On('delete-confirmed')]
    public function delete() {
        $this->article->delete();
        $this->close();

        $this->dispatch('article-deleted');
    }

    public function render()
    {
        return view('livewire.confirm-delete');
    }
}
