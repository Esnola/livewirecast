<?php

  use App\Livewire\Concerns\Analytics;
  use Livewire\Attributes\Computed;
  use Livewire\Attributes\Title;
  use Livewire\Attributes\Url;
  use Livewire\Component;

  new #[Title('Analytics Posts')]
  class extends Component {
    public string $period = 'month';

    #[Url( history: true)]
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

  };
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

    <div class="mb-8 grid gap-4 md:grid-cols-3 relative">


      @island(name:'metrics', lazy:true, always:true)
      @placeholder
      <flux:skeleton class="h-30" animate="shimmer"/>
      <flux:skeleton class="h-30" animate="shimmer"/>
      <flux:skeleton class="h-30" animate="shimmer"/>
      @endplaceholder

      @island(always:true)
      <x-pages::analytics.metric wire:poll.5s heading="Views" :number="$this->views" :change="12"/>
      @endisland
      <x-pages::analytics.metric heading="Visitors" :number="$this->visitors" :change="22"/>
      <x-pages::analytics.metric heading="Average" :number="$this->avgTime" :change="-15"/>
      @endisland


      <div class="absolute top-0 bottom-0 flex flex-col items-start left-full pl-4">
        <flux:button wire:click="$refresh" wire:island="metrics" icon="arrow-path" variant="subtle" size="sm"
                     class="cursor-pointer"/>
      </div>

    </div>


    <div class="grid gap-6 lg:grid-cols-2">
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
