{{-- resources/views/layouts/app.blade.php --}}
        <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>{{ $title ?? config('app.name') }}</title>

  @vite(['resources/css/app.css', 'resources/js/app.js'])

  @livewireStyles
  @fluxAppearance
</head>

<body class="min-h-screen bg-white dark:bg-zinc-800 antialiased">

<x-sidebar/>


<flux:main>
  <div class="mb-2 flex items-center justify-end">
    <flux:radio.group x-data variant="segmented" x-model="$flux.appearance" class="max-w-fit">
      <flux:radio value="light" icon="sun" class="data-checked:pointer-events-none cursor-pointer">Light</flux:radio>
      <flux:radio value="dark" icon="moon" class="data-checked:pointer-events-none cursor-pointer">Dark</flux:radio>
    </flux:radio.group>
  </div>
  {{ $slot }}
</flux:main>

@livewireScripts
@fluxScripts
</body>
</html>
