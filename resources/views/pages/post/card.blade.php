<?php

  use Livewire\Component;
  use App\Models\Article

new class extends Component
{
  public Article $article;

f
};
?>

@placeholder
<flux:skeleton animate="shimmer" class="min-h-56 rounded-lg"/>
@endplaceholder

<flux:card class="flex flex-col gap-4">
  <flux:heading size="lg">{{$article->creator}}</flux:heading>
</flux:card>
