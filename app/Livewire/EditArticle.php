<?php

namespace App\Livewire;

use App\Livewire\Forms\ArticleForm;
use App\Models\Article;
use Livewire\WithFileUploads;

class EditArticle extends AdminComponent
{
    use WithFileUploads;

    public ArticleForm $form;

    public function mount(Article $article): void
    {
        $this->form->setArticle($article);
    }

    public function downloadPhoto() {
        return response()->download(\Storage::disk('public')->path($this->form->photo_path),
            'article.' . 'png');
    }

    public function save() {

        $this->form->update();

        $this->redirectIntended('/dashboard');

        session()->flash('message', 'Article updated successfully.');

        //$this->redirect('/dashboard/articles',navigate: true);
        $this->redirect(ArticleList::class,navigate: true);
    }

    public function render()
    {
        return view('livewire.edit-article');
    }
}
