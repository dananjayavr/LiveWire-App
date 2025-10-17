<?php

namespace App\Livewire;

use App\Models\Article;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Session;
use Livewire\Attributes\Title;
use Livewire\WithPagination;
use Symfony\Component\HttpKernel\Attribute\Cache;


#[Title('Manage Articles')]
class ArticleList extends AdminComponent
{
    use withPagination;

    #[Session(key: 'published')]
    public $showOnlyPublished = false;

    #[On('article-deleted')]
    public function refresh() {
        cache()->forget('published-count');
    }

    #[Computed]
    public function articles() {
        $query = Article::query();
        if($this->showOnlyPublished) {
            $query->where('articles.published', true);
        }

        return $query->orderByDesc('articles.created_at')
                ->paginate(10, pageName: 'articles-page');
    }

    public function togglePublished($showOnlyPublished) {
        $this->showOnlyPublished = $showOnlyPublished;
        $this->resetPage(pageName: 'articles-page');
    }

    public function render()
    {
        return view('livewire.article-list',[
            'articles' => $this->articles(),
        ]);
    }
}
