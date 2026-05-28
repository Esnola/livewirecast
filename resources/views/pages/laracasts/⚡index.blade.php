<?php

  use Livewire\Component;

  new class extends Component {
    //
  };
?>

<div>
  <flux:main container>
    <div class="flex items-center jusitfy-center gap-2 mb-8 -ml-6">
      <flux:link href="{{ route('laracasts.index') }}" class="text-sm">
        <flux:icon name="arrow-left" class="mr-1"/>
      </flux:link>
      Laracasts Index
    </div>
    <div class="flex items-center jusitfy-center gap-8">
      <div class="flex items-center gap-4 bg-zinc-800 max-w-fit px-12 py-5 rounded">
        <flux:link href="https://laracasts.com/series/everything-new-in-livewire-4" target="_blank">
          <img src="https://assets.laracasts.com/images/primary-logo.svg"/>
        </flux:link>
      </div>
      <flux:link href="https://jetbrains.com" target="_blank" class="bg-zinc-800 rounded-md ">
        <x-partials.logos.jetbrains/>
      </flux:link>
      <div class="flex w-100">
        <x-partials.logos.suite-jetbrains/>
      </div>
    </div>
    <div class="flex w-full  justify-center ">
      <x-partials.logos.colaboration-jetbrains/>
    </div>

    <div>
      <flux:link href="https://laracasts.com/series/everything-new-in-livewire-4" target="_blank"
                 class="text-blue-500 hover:underline">
        Learn Livewire
      </flux:link>
      <div class="flex flex-col mt-4">
        <div class="border border-zinc-400/60 p-4 rounded-lg text-gray-400 text-sm flex ">

          <x-main-link link="laracasts.cards" title="Drag & Drop"/>
          <flux:icon name="minus" class="rotate-90 size-10"/>
          <x-main-link link="laracasts.cards-version" title="Drag & Drop Copy"/>
          <flux:icon name="minus" class="rotate-90 size-10"/>
          <x-main-link link="laracasts.interceptors" title="Intercerpetors"/>
        </div>
      </div>
    </div>
  </flux:main>
</div>
