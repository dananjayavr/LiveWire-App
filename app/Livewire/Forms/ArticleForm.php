<?php

namespace App\Livewire\Forms;

use App\Models\Article;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ArticleForm extends Form
{
    public ?Article $article;
    #[Locked]
    public int $id;

    #[Validate('required')]
    public $title = '';

    #[Validate('required')]
    public $content = '';

    public $published = false;
    public $notifications = [];
    public $allowNotifications = false;
    public $photo_path = '';
    #[Validate('image|max:1024|nullable')]
    public $photo;


    public function setArticle(Article $article): void {
        $this->id = $article->id;
        $this->title = $article->title;
        $this->content = $article->content;
        $this->published = $article->published;
        $this->notifications = $article->notifications ?? [];

        $this->allowNotifications = count($this->notifications) > 0;

        $this->photo_path = $article->photo_path;

        $this->article = $article;
    }

    public function store() {
        $this->validate();

        if(!$this->allowNotifications) {
            $this->notifications = [];
        }

        if($this->photo) {
            $this->photo_path = $this->photo->storePublicly('article_photos',['disk' => 'public']);
        }

        Article::create($this->only(['title', 'content','published','notifications','photo_path']));

        cache()->forget('published-count');
    }

    public function update() {
        $this->validate();

        if(!$this->allowNotifications) {
            $this->notifications = [];
        }

        if($this->photo) {
            $this->photo_path = $this->photo->storePublicly('article_photos',['disk' => 'public']);
        }

        $this->article->update(
            $this->only(['title', 'content','published','notifications','photo_path'])
        );

        cache()->forget('published-count');
    }
}
