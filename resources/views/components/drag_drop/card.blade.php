
<div>
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
</div>
