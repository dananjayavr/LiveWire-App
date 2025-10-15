<?php

namespace App\Livewire;

use App\Livewire\Forms\ArticleForm;
use App\Models\Article;

class EditArticle extends AdminComponent
{
    public ArticleForm $form;

    public function mount(Article $article): void
    {
        $this->form->setArticle($article);
    }

    public function save() {

        $this->form->update();

        $this->redirect('/dashboard/articles',navigate: true);
    }

    public function render()
    {
        return view('livewire.edit-article');
    }
}
