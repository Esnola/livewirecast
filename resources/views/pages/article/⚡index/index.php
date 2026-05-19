<?php
use Livewire\Component;
use App\Models\Article;

new #[Layout('layouts::app', ['title' => 'Listing articles'])]
class extends Component
{
public function render()
{
$articles = Article::all();

return view('pages.article.⚡index.index', compact('articles'));
}
};
