<?php

  use Livewire\Attributes\Async;
  use Livewire\Attributes\Computed;
  use Livewire\Attributes\Renderless;
  use Livewire\Attributes\Session;
  use Livewire\Attributes\Title;
  use Livewire\Attributes\Url;
  use Livewire\Component;

  new #[Title('Drag & Drop')]
  class extends Component
  {

    #[Computed]
    public array $logos = ['blender', 'blueprint', 'bootstrap', 'brave', 'browserstack',
      'chrome', 'clion', 'cloudflare-icon', 'composer', 'couchbase', 'dart', 'dataspell', 'datagrip',
      'deno', 'firefox', 'goland', 'google-home', 'intellij-idea', 'jetbrains', 'jetbrains',
      'microsoft-edge', 'opera', 'phpstorm', 'pycharm', 'rubymine', 'rubymine', 'safari',
      'visual-studio', 'visual-studio-code', 'webstorm', ];

    #[Session]
    public array $sortedLogos;

    public function mount(): void
    {
      $this->sortedLogos = $this->logos;
    }


    #[Renderless, Async]
    public function handleSort($item, $position)
    {
      // 1. Remove the item from its current home...
      $this->sortedLogos = array_diff($this->sortedLogos, [$item]);
      // 2. Re-index to close the gap...
      $this->sortedLogos = array_values($this->sortedLogos);
      // 3. Splice the item into the new spot...
      array_splice($this->sortedLogos, $position, 0, [$item]);
    }
  }
?>

<div>
  <flux:main container>
    <div class="mb-8 flex items-center justify-between gap-4">
      <div>
        <flux:heading size="xl">Drag & Drop</flux:heading>
        <flux:subheading>
          All images credits for
          <flux:link href="https://brandpnglogo.com/">
            BrandPNGLogo
          </flux:link>

          {{--<flux:link href="https://www.freepik.com/free-photos-vectors/background">Background vector created by rawpixel.com - www.freepik.com</flux:link>--}}
        </flux:subheading>
      </div>
    </div>

    @island(name:'metrics', lazy:true, always:true)
    @placeholder
    <div class="grid gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 mt-12" wire:key="placeholder">
      @foreach($logos as $img )
        <flux:skeleton class="h-30" animate="shimmer"/>
      @endforeach
    </div>
    @endplaceholder
    <div class="grid gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 mt-12" wire:sort="handleSort">
      @foreach ($this->logos as $index => $logos)
        <div class="rounded-lg border border-zinc-200 dark:border-zinc-700 p-4 flex items-center justify-center relative"
             wire:sort:item="{{ $sortedLogos[$index] }}"
             wire:key="{{ $sortedLogos[$index] }}">
          <img src="https://logo.svgcdn.com/logos/{{ $logos }}.png" alt="Logo Image of {{$logos}}"
               class="h-16 object-contain"/>
          <flux:icon.list-bullet wire:sort:handle
                                 class="size-6 flex items-center absolute max-w-fit right-2 top-1 cursor-pointer text-gray-500 hover:text-gray-700 "/>
        </div>
      @endforeach
    </div>
    @endisland
  </flux:main>
</div>
