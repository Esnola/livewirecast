<?php

  use App\Livewire\Concerns\Analytics;
  use Livewire\Attributes\Async;
  use Livewire\Attributes\Computed;
  use Livewire\Attributes\Renderless;
  use Livewire\Attributes\Session;
  use Livewire\Attributes\Title;
  use Livewire\Attributes\Url;
  use Livewire\Component;

  new #[Title('Analytics Sort')]
  class extends Component {
    public string $period = 'month';

    #[Url(history: true)]
    public int $postsPage = 1;

    public function loadMorePosts()
    {
      $this->postsPage++;
    }

    public array $periods = [
      'day' => 'Today',
      'week' => 'Week',
      'month' => 'Month',
      'year' => 'Year',
    ];

    #[Computed]
    public function views(): int
    {
      //   usleep(1.3 * 1000000);
      return Analytics::period($this->period)->views();
    }

    #[Computed]
    public function visitors(): int
    {
      return Analytics::period($this->period)->visitors();
    }

    #[Computed]
    public function avgTime(): string
    {
      return Analytics::period($this->period)->avgTime();
    }

    #[Computed]
    public function topPosts()
    {
      return Analytics::period($this->period)->topPosts(page: $this->postsPage);
    }

    #[Computed]
    public function topCountries()
    {
      return Analytics::period($this->period)->topCountries();
    }

    #[Computed]
    public function metrics(): array
    {
      return [
        'views' => [
          'heading' => 'Views',
          'number' => $this->views,
          'change' => 12,
        ],
        'visitors' => [
          'heading' => 'Visitors',
          'number' => $this->visitors,
          'change' => 22,
        ],
        'avgTime' => [
          'heading' => 'Average',
          'number' => $this->avgTime,
          'change' => -15,
        ],
      ];
    }


    #[Session]
    public $sortedMetrics = [
      'views',
      'visitors',
      'avgTime'
    ];

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

    public function updating($property)
    {
      if ($property === 'period') {
        $this->reset('postsPage');
        $this->renderIsland('posts');
      }
    }

  }
?>

<div>
  <flux:main container>
    <div class="mb-8 flex items-center justify-between gap-4">
      <div>
        <flux:heading size="xl">Analytics</flux:heading>
        <flux:subheading>
          Summary of visits, users, and content performance.
        </flux:subheading>
      </div>
      <flux:select wire:model.live="period" class="max-w-48">
        @foreach ($periods as $value => $label)
          <flux:select.option value="{{ $value }}">
            {{ $label }}
          </flux:select.option>
        @endforeach
      </flux:select>
    </div>

    @island(name:'metrics', lazy:true, always:true)
    @placeholder
    <div class="mb-8 grid gap-4 md:grid-cols-3 relative" wire:key="placeholder">
      <flux:skeleton class="h-30" animate="shimmer"/>
      <flux:skeleton class="h-30" animate="shimmer"/>
      <flux:skeleton class="h-30" animate="shimmer"/>
    </div>
    @endplaceholder
    <div class="mt-8 grid grid-cols-3 gap-6 relative" wire:sort="handleSort">
      @foreach ($this->sortedMetrics as $name )
        <x-pages::analytics.metric
                :wire:key="$name"
                :wire:sort:item="$name"
                :heading="$this->metrics[$name]['heading']"
                :number="$this->metrics[$name]['number']"
                :change="$this->metrics[$name]['change']"
        />
      @endforeach
      <div wire:sort:ignore class="absolute max-w-full inset-0 flex flex-col items-start left-full pl-4">
        <flux:button wire:click="$refresh" wire:island="metrics" icon="arrow-path" class="cursor-pointer"/>
      </div>
    </div>
    @endisland

    <div class="grid gap-6 lg:grid-cols-2 mt-12">
      <flux:card class="lg:col-span-2">
        <div class="mb-4">
          <flux:heading>Top posts</flux:heading>
          <flux:subheading>Posts with the most views in the selected period.</flux:subheading>
        </div>

        <flux:table>
          <flux:table.columns>
            <flux:table.column>#Id</flux:table.column>
            <flux:table.column>Views</flux:table.column>
            <flux:table.column>Title</flux:table.column>
            <flux:table.column>Author</flux:table.column>
            <flux:table.column>Likes</flux:table.column>
          </flux:table.columns>

          <flux:table.rows>
            @island(name:'posts')
            @foreach ($this->topPosts as $post)
              <flux:table.row>
                <flux:table.cell>#{{ $post->id }}</flux:table.cell>
                <flux:table.cell>{{ number_format($post->views, 0, ',', '.') }}</flux:table.cell>
                <flux:table.cell>{{ $post->title }}</flux:table.cell>
                <flux:table.cell>{{ $post->creator }}</flux:table.cell>
                <flux:table.cell>{{ number_format($post->likes, 0, ',', '.') }}</flux:table.cell>
              </flux:table.row>
            @endforeach
            @endisland
          </flux:table.rows>
        </flux:table>
        <flux:header>
          <flux:button
                  wire:click="loadMorePosts"
                  wire:island="posts"
                  class="cursor-pointer mx-auto"
                  variant="primary" size="sm" icon="chevron-down">
            Load More
          </flux:button>
        </flux:header>
      </flux:card>

      <flux:card>
        <div class="mb-4">
          <flux:heading>Top countries</flux:heading>
          <flux:subheading>Estimated traffic distribution.</flux:subheading>
        </div>

        <flux:table>
          <flux:table.columns>
            <flux:table.column>Country</flux:table.column>
            <flux:table.column>Vists</flux:table.column>
          </flux:table.columns>

          <flux:table.rows>
            @foreach ($this->topCountries as $country)
              <flux:table.row>
                <flux:table.cell>{{ $country['country'] }}</flux:table.cell>
                <flux:table.cell>
                  {{ number_format($country['views'], 0, ',', '.') }}
                </flux:table.cell>
              </flux:table.row>
            @endforeach
          </flux:table.rows>
        </flux:table>
      </flux:card>
    </div>
  </flux:main>
</div>
