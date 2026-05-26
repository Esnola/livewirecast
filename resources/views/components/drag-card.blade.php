
<div>
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
                :heading="$heading"
                :number="$number"
                :change="$change"/>
      @endforeach
      <div wire:sort:ignore class="absolute max-w-full inset-0 flex flex-col items-start left-full pl-4">
        <flux:button wire:click="$refresh" wire:island="metrics" icon="arrow-path" class="cursor-pointer"/>
      </div>
    </div>
    @endisland
</div>
