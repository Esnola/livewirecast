

  @placeholder
  <div class="flex flex-col w-full lg:max-w-7xl">
    <div class=" justify-between items-center mb-4">
      <flux:heading size="xl">Record</flux:heading>
      <flux:text class="mt-2">Manage your blog posts and articles</flux:text>
    </div>
    <div class="w-full grid grid-cols-3 gap-4 pr-20">
      @foreach(range(1, 6) as $_)
        <flux:skeleton animate="shimmer" class="min-h-56 rounded-lg"/>
      @endforeach
    </div>
  </div>
  @endplaceholder
