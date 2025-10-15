<?php

namespace App\Livewire;

use App\Models\Article;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Articles')]
class ArticleIndex extends Component
{
    /*
     * Reason that the mount() method below is commented is to show
     * two approaches to injecting data to components
     * If you inject from mount() method, the data is fetched once (when the
     * component is loaded to the browser).
     * On the other hand, the render() method gets called each time a component
     * gets rendered in the browser.
     * The better approach in that case is to use the render method so we always
     * make sure to obtain most up-to-date information each time the component
     * is rendered.
     */
    //public $articles = [];

/*    public function mount(): void
    {
        $this->articles = Article::all();
    }*/
    public function render()
    {
        return view('livewire.article-index',[
            'articles' => Article::all()->sortDesc()
        ]);
    }
}
