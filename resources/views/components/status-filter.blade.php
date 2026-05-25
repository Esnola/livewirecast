@props([
 'kbshorts' => ['⌘S', '⌘P', '⌘A',],
 'statuses' =>App\Enums\StatusEnum::cases() ,
 'title' => 'Status Filter',
 'statusValue' => 1,
])


<flux:dropdown class="">
  <flux:button class="cursor-pointer" icon:trailing="chevron-down">{{ $title }}</flux:button>
  <flux:menu>
      @foreach( $statuses as  $index => $status )
      <flux:menu.item
              icon="{{ $status->icon() }}"
              kbd="{{ $kbshorts[$index]}}"
              class="cursor-pointer {{$index === $statusValue ? 'bg-zinc-200 dark:bg-zinc-500 pointer-events-none':'' }}">
        {{ $status->label() }}
      </flux:menu.item>
    @endforeach
  </flux:menu>
</flux:dropdown>
