<div>
  <h1 class="text-4xl font-bold text-center mb-4">Counter App</h1>

  <div class="flex flex-col border rounded-t-md bg-olive-500">
    <div class="flex bg-olive-200 rounded h-48 w-full items-center justify-center mb-4">
      <h1 class="text-4xl font-bold mb-4">{{ $count }}</h1>
    </div>

    <div class="inline-flex rounded">

      <x-partials.counter.button action="increment" label="More" />

      <x-partials.counter.button action="resume" label="Reset" />

      <x-partials.counter.button action="decrement" label="Less" />
    </div>
  </div>
</div>
