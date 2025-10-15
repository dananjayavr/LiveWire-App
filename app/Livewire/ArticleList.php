<?php

namespace App\Livewire;

use App\Models\Article;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;

#[Title('Manage Articles')]
class ArticleList extends AdminComponent
{
    #[On('article-deleted')]
    public function refresh() {}

    public function render()
    {
        return view('livewire.article-list',[
            'articles' => Article::all()->sortDesc()
        ]);
    }
}
