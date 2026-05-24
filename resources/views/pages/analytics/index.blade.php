<?php

  use App\Livewire\Concerns\Analytics;
  use Livewire\Attributes\Computed;
  use Livewire\Attributes\Lazy;
  use Livewire\Attributes\Title;
  use Livewire\Component;

  new #[Lazy, Title('Analytics Posts')]
  class extends Component {
    public string $period = 'month';

    public array $periods = [
      'day' => 'Today',
      'week' => 'Week',
      'month' => 'Month',
      'year' => 'Year',
    ];


    #[Computed]
    public function views(): int
    {

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
      return Analytics::period($this->period)->avgTime() ;
    }

    #[Computed]
    public function topPosts()
    {
      return Analytics::period($this->period)->topPosts();
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

    <div class="mb-8 grid gap-4 md:grid-cols-4 relative">


      @island(name:'alone')
      <x-pages::analytics.metric heading="Alone" :number="$this->views" :change="-9">
        <flux:button wire:click="$refresh" icon="arrow-path" variant="subtle" size="sm" class="cursor-pointer"/>
      </x-pages::analytics.metric>
      @endisland

      @island(name:'views')
        <x-pages::analytics.metric heading="Metrics User View" :number="$this->views" :change="12">
          <flux:button wire:click="$refresh" icon="arrow-path" variant="subtle" size="sm" class="cursor-pointer"/>
        </x-pages::analytics.metric>
      @endisland


      @island(name:'visitors')
      <x-pages::analytics.metric heading="Metrics User Visitors" :number="$this->visitors" :change="22">
        <flux:button wire:click="$refresh" icon="arrow-path" variant="subtle" size="sm" class="cursor-pointer"/>
      </x-pages::analytics.metric>
      @endisland

      @island(name:'average')
      <x-pages::analytics.metric heading="Metrics Average" :number="$this->avgTime" :change="-15">
        <flux:button wire:click="$refresh" icon="arrow-path" variant="subtle" size="sm" class="cursor-pointer"/>
      </x-pages::analytics.metric>
      @endisland


      <div class="absolute top-0 bottom-0 flex flex-col items-start left-full pl-4">
        <flux:button wire:click="$refresh" wire:island="alone" icon="arrow-path" variant="subtle" size="sm" class="cursor-pointer">Only Alone</flux:button>
      </div>

    </div>


    <div class="grid gap-6 lg:grid-cols-2">
      <flux:card>
        <div class="mb-4">
          <flux:heading>Top posts</flux:heading>
          <flux:subheading>Posts with the most views in the selected period.</flux:subheading>
        </div>

        <flux:table>
          <flux:table.columns>
            <flux:table.column>Post</flux:table.column>
            <flux:table.column>Author</flux:table.column>
            <flux:table.column>Visits</flux:table.column>
            <flux:table.column>Likes</flux:table.column>
          </flux:table.columns>

          <flux:table.rows>
            @forelse ($this->topPosts as $post)
              <flux:table.row>
                <flux:table.cell>{{ $post->title }}</flux:table.cell>
                <flux:table.cell>{{ $post->creator }}</flux:table.cell>
                <flux:table.cell>{{ number_format($post->views, 0, ',', '.') }}</flux:table.cell>
                <flux:table.cell>{{ number_format($post->likes, 0, ',', '.') }}</flux:table.cell>
              </flux:table.row>
            @empty
              <flux:table.row>
                <flux:table.cell colspan="4">
                  There are no posts in this period.
                </flux:table.cell>
              </flux:table.row>
            @endforelse
          </flux:table.rows>
        </flux:table>
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
