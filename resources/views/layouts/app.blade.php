<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>{{ $title ?? config('app.name') }}</title>

  @vite(['resources/css/app.css', 'resources/js/app.js'])

  @livewireStyles
  @fluxAppearance
</head>

<body class="min-h-screen bg-white dark:bg-zinc-800 antialiased">

<flux:sidebar
        sticky
        collapsible
        class="bg-zinc-50 dark:bg-zinc-900 border-r border-zinc-200 dark:border-zinc-700"
>
  <flux:sidebar.header class="relative flex items-center px-2 py-2 min-h-12 overflow-visible">
    <flux:sidebar.brand
            class="in-data-flux-sidebar-collapsed-desktop:hidden"
            href="#"
            logo="https://fluxui.dev/img/demo/logo.png"
            logo:dark="https://fluxui.dev/img/demo/dark-mode-logo.png"
            name="Acme Inc."
    />

    <flux:sidebar.collapse
            tooltip="Toggle sidebar"
            class="ml-auto shrink-0 opacity-100! in-data-flux-sidebar-collapsed-desktop:opacity-100! in-data-flux-sidebar-collapsed-desktop:ml-0 in-data-flux-sidebar-collapsed-desktop:absolute in-data-flux-sidebar-collapsed-desktop:left-1/2 in-data-flux-sidebar-collapsed-desktop:-translate-x-1/2"
    />
</flux:sidebar.header>

  <flux:sidebar.nav class="px-2 space-y-1">
    {{-- TOP --}}
    <flux:sidebar.item icon="home" href="/" :current="request()->is('/')" class="sidebar-item">
      Home
    </flux:sidebar.item>


    {{-- ================= EXPANDED ================= --}}
    <div class="space-y-1 in-data-flux-sidebar-collapsed-desktop:hidden">
      {{-- ANALITICS --}}
      <flux:sidebar.group expandable :expanded="request()->routeIs('analytics.*')" icon="chart-pie" heading="Analytics" class="sidebar-group">
        <flux:sidebar.item icon="chart-bar" href="{{ route('analytics.index') }}" class="sidebar-item">
          Analytics
        </flux:sidebar.item>
        <flux:sidebar.item icon="chart-bar-square" href="{{ route('analytics.sort') }}" class="sidebar-item">
          Analytics Sort
        </flux:sidebar.item>
      </flux:sidebar.group>

      {{-- PRODUCTS --}}
      <flux:sidebar.group expandable :expanded="request()->routeIs('product.*')" icon="rectangle-group" heading="Products" class="sidebar-group">
        <flux:sidebar.item icon="command-line" href="{{ route('product.index') }}" :current="request()->routeIs('product.index')" class="sidebar-item">
          Product Listing
        </flux:sidebar.item>
        <flux:sidebar.item icon="device-phone-mobile" href="#" class="sidebar-item">
          Android app
        </flux:sidebar.item>
      </flux:sidebar.group>

      {{-- POSTS --}}
      <flux:sidebar.group expandable :expanded="request()->routeIs('post.*')" icon="chat-bubble-bottom-center-text" heading="Posts" class="sidebar-group">
        <flux:sidebar.item icon="document-text" href="{{ route('post.index') }}" :current="request()->routeIs('post.index')" class="sidebar-item">
          Posts List
        </flux:sidebar.item>
        <flux:sidebar.item icon="command-line" href="{{ route('post.create') }}" :current="request()->routeIs('post.create')" class="sidebar-item">
          Create
        </flux:sidebar.item>
        <flux:sidebar.item icon="inbox" badge="12" href="#" class="sidebar-item">
          Inbox
        </flux:sidebar.item>
      </flux:sidebar.group>

      {{-- SALES --}}
      <flux:sidebar.group expandable :expanded="request()->routeIs('order.*')" icon="credit-card" heading="Sales" class="sidebar-group"  >
        <flux:sidebar.item icon="banknotes" href="{{ route('order.index') }}" :current="request()->routeIs('order.index')" class="sidebar-item">
          Sales
        </flux:sidebar.item>
        <flux:sidebar.item icon="device-phone-mobile" href="#" class="sidebar-item">
          Android app
        </flux:sidebar.item>
        <flux:sidebar.item icon="bookmark-square" href="#" class="sidebar-item">
          Brand guidelines
        </flux:sidebar.item>
      </flux:sidebar.group>
    </div>

    {{-- ================= COLLAPSED ================= --}}
    <div class="hidden in-data-flux-sidebar-collapsed-desktop:block space-y-1">

      {{-- PRODUCTS --}}
      <flux:dropdown>
        <flux:sidebar.item icon="rectangle-group" href="#" :current="request()->routeIs('product.*')" tooltip="Products" class="sidebar-item"/>
        <flux:menu>
          <flux:menu.item icon="command-line" href="{{ route('product.index') }}">Product Listing</flux:menu.item>
          <flux:menu.item icon="device-phone-mobile" href="#">Android app</flux:menu.item>
        </flux:menu>
      </flux:dropdown>

      {{-- POSTS --}}
      <flux:dropdown>
        <flux:sidebar.item icon="chat-bubble-bottom-center-text" href="#" :current="request()->routeIs('post.*')" tooltip="Posts" class="sidebar-item"/>
        <flux:menu>
          <flux:menu.item icon="document-text" href="{{ route('post.index') }}">Posts List</flux:menu.item>
          <flux:menu.item icon="command-line" href="{{ route('post.create') }}">Create</flux:menu.item>
          <flux:menu.item icon="inbox" href="#">Inbox</flux:menu.item>
        </flux:menu>
      </flux:dropdown>

      {{-- SALES --}}
      <flux:dropdown>
        <flux:sidebar.item icon="credit-card" href="#" :current="request()->routeIs('order.*')" tooltip="Sales" class="sidebar-item"/>
        <flux:menu>
          <flux:menu.item icon="banknotes" href="{{ route('order.index') }}">Sales</flux:menu.item>
          <flux:menu.item icon="device-phone-mobile" href="#">Android app</flux:menu.item>
        </flux:menu>
      </flux:dropdown>
    </div>

  </flux:sidebar.nav>
  <flux:sidebar.spacer/>
  <flux:sidebar.nav class="px-2 space-y-1">
    <flux:sidebar.item icon="cog-6-tooth" href="#" class="sidebar-item">
      Settings
    </flux:sidebar.item>
    <flux:sidebar.item icon="information-circle" href="#" class="sidebar-item">
      Help
    </flux:sidebar.item>
  </flux:sidebar.nav>
</flux:sidebar>

<flux:main>
  <div class="mb-2  flex items-center justify-end ">
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
