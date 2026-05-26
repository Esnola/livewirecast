<?php

  use Livewire\Attributes\Async;
  use Livewire\Attributes\Computed;
  use Livewire\Attributes\Renderless;
  use Livewire\Attributes\Session;
  use Livewire\Attributes\Title;
  use Livewire\Attributes\Url;
  use Livewire\Component;

  new #[Title('Drag & Drop')]
  class extends Component {

    public function sleep()
    {
      sleep(2);
  }
    #[Session]
    public array $images = [
      'https://logo.svgcdn.com/logos/datagrip.png',
      'https://logo.svgcdn.com/logos/dataspell.png',
      'https://logo.svgcdn.com/logos/goland.png',
      'https://logo.svgcdn.com/logos/phpstorm.png',
      'https://logo.svgcdn.com/logos/jetbrains.png',
      'https://logo.svgcdn.com/logos/pycharm.png',
      'https://logo.svgcdn.com/logos/webstorm.png',
      'https://logo.svgcdn.com/logos/clion.png',
      'https://logo.svgcdn.com/logos/rubymine.png',
      'https://logo.svgcdn.com/devicon/intellij-original.png',
      'https://logo.svgcdn.com/logos/jetbrains.png',
      'https://logo.svgcdn.com/logos/rubymine.png',
      'https://logo.svgcdn.com/logos/blueprint.png',
      'https://logo.svgcdn.com/logos/brave.png',
      'https://logo.svgcdn.com/logos/chrome.png',
      'https://logo.svgcdn.com/logos/firefox.png',
      'https://logo.svgcdn.com/logos/opera.png',
      'https://logo.svgcdn.com/logos/safari.png',
      'https://logo.svgcdn.com/devicon/vscode-original.png',
      'https://logo.svgcdn.com/logos/microsoft-edge.png',
      'https://logo.svgcdn.com/devicon/cloudflareworkers-original.png',
      'https://logo.svgcdn.com/logos/deno.png',
      'https://logo.svgcdn.com/devicon/angularjs-original.png',
      'https://logo.svgcdn.com/devicon/apacheairflow-original.png',
      'https://logo.svgcdn.com/logos/composer.png',
      'https://logo.svgcdn.com/logos/browserstack.png',
      'https://logo.svgcdn.com/devicon/canva-original.png',
      'https://logo.svgcdn.com/devicon/delphi-original.png',
      'https://logo.svgcdn.com/devicon/gardener-original.png',
      'https://logo.svgcdn.com/devicon/firebird-original.png'
    ];



    #[Session]
    public array $sortedMetrics = [];

    public function mount(): void
    {
    $this->sortedMetrics = array_map(
      fn(string $url) => rtrim(pathinfo($url, PATHINFO_FILENAME), '.'),
      $this->images
    );;
    }


    #[Renderless, Async]
    public function handleSort($item, $position)
    {
      // 1. Remove the item from its current home...
      $this->sortedMetrics = array_diff($this->sortedMetrics, [$item]);

      // 2. Re-index to close the gap...
      $this->sortedMetrics = array_values($this->sortedMetrics);

      // 3. Splice the item into the new spot...
      array_splice($this->sortedMetrics, $position, 0, [$item]);
    }


  }
?>

<div>
  <flux:main container>
    <div class="mb-8 flex items-center justify-between gap-4">
      <div>
        <flux:heading size="xl">Drag & Drop</flux:heading>
        <flux:subheading>
         All images credits for <flux:link href="https://brandpnglogo.com/">
            BrandPNGLogo</flux:link>

          {{--<flux:link href="https://www.freepik.com/free-photos-vectors/background">Background vector created by rawpixel.com - www.freepik.com</flux:link>--}}
        </flux:subheading>
      </div>
    </div>

    @island(name:'metrics', lazy:true, always:true)
      @placeholder
    <div class="grid gap-6 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 mt-12" wire:key="placeholder">
      @foreach($images as $img )
          <flux:skeleton class="h-30" animate="shimmer"/>
      @endforeach
    </div>
      @endplaceholder
    <div class="grid gap-6 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 mt-12" wire:sort="handleSort">
      @foreach ($this->images as $index => $image)
        <div class="rounded-lg border border-zinc-200 dark:border-zinc-700 p-4 flex items-center justify-center relative"
             wire:sort:item="{{ $sortedMetrics[$index] }}"
             wire:key="{{ $sortedMetrics[$index] }}"
        >
          <img src="{{ $image }}" alt="Image" class="h-16 object-contain"/>
          <flux:icon.list-bullet wire:sort:handle
                                 class="size-6 flex items-center absolute max-w-fit right-2 top-1 cursor-pointer text-gray-500 hover:text-gray-700 "/>
        </div>
      @endforeach
    </div>
    @endisland

  </flux:main>
</div>

<style>
  .sortable-chosen{

  }
</style>
