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

    #[Computed]
    public array $logos = ['blender', 'blueprint', 'bootstrap', 'brave', 'browserstack',
      'chrome', 'clion', 'cloudflare-icon', 'composer', 'couchbase', 'dart', 'dataspell', 'datagrip',
      'deno', 'firefox', 'goland', 'google-home', 'intellij-idea', 'jetbrains', 'jetbrains',
      'microsoft-edge', 'opera', 'phpstorm', 'pycharm', 'rubymine', 'rubymine', 'safari',
      'visual-studio', 'visual-studio-code', 'webstorm',
    ];

    #[Session]
    public array $sortedLogos;

    public function mount(): void
    {
      $this->sortedLogos = $this->logos;
    }


    #[Renderless, Async]
    public function handleSort($item, $position)
    {
      // 1. Remove the item from its current place...
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
          <flux:link href="https://brandpnglogo.com/" target="_blank">
            BrandPNGLogo
          </flux:link>
        </flux:subheading>
      </div>
    </div>

    <x-drag_drop.card :sortedLogos="$sortedLogos" :logos="$logos"/>

  </flux:main>
</div>

</script>
