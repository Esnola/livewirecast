<?php

  $sidebarGroups = [
    [
      'linkgroup'   => 'analytics.*',
      'icongroup'   => 'chart-pie',
      'headingroup' => 'Analitics',
      'elements'    => [
        ['title' => 'Analitics',  'icon' => 'chart-bar', 'link' => 'analytics.index',  'counter' => null],
        ['title' => 'Create', 'icon' => 'chart-bar-square',  'link' => 'analytics.sort', 'counter' => null],
      ],
    ],
    [
      'linkgroup'   => 'post.*',
      'icongroup'   => 'chat-bubble-bottom-center-text',
      'headingroup' => 'Posts',
      'elements'    => [
        ['title' => 'Posts',  'icon' => 'document-text', 'link' => 'post.index',  'counter' => $postsCount ?? 0],
        ['title' => 'Create', 'icon' => 'command-line',  'link' => 'post.create', 'counter' => null],
      ],
    ],
    [
      'linkgroup'=>"product.*",
      'icongroup'=>"rectangle-group",
      'headingroup'=>"Products",
      'elements'=>[
        ['title'=>'Products', 'icon'=> 'command-line', 'link'=> 'product.index','counter' => $productsCount ?? 0],
        ['title'=>'Android app','icon'=>'device-phone-mobile','link'=>null,'counter'=> null],
      ],
    ],
    [
      'linkgroup'   => 'order.*',
      'icongroup'   => 'credit-card',
      'headingroup' => 'Sales',
      'elements'    => [
        ['title' => 'Sales', 'icon' => 'banknotes','link' => 'order.index', 'counter' => $ordersCount ?? 0],
        ['title' => 'Android app', 'icon' => 'command-line', 'link' => null, 'counter' => null],
      ],
    ]
  ];

?>

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
            class="ml-auto shrink-0 opacity-100! in-data-flux-sidebar-collapsed-desktop:opacity-100! in-data-flux-sidebar-collapsed-desktop:-ml-4 in-data-flux-sidebar-collapsed-desktop:absolute in-data-flux-sidebar-collapsed-desktop:left-1/2 in-data-flux-sidebar-collapsed-desktop:-translate-x-1/2"
    />
  </flux:sidebar.header>

  <flux:sidebar.nav class="px-2 space-y-1">
    {{-- TOP --}}
    <flux:sidebar.item icon="home" href="/" :current="request()->is('/')" class="sidebar-item">
      Home
    </flux:sidebar.item>


    {{-- ================= EXPANDED ================= --}}

    <div class="space-y-1 in-data-flux-sidebar-collapsed-desktop:hidden">
      @foreach($sidebarGroups as $group)
        <x-sidebar-group :linkgroup="$group['linkgroup']"
                :icongroup="$group['icongroup']"
                :headingroup="$group['headingroup']"
                :elements="$group['elements']"
        />
      @endforeach
    </div>

    {{-- ================= COLLAPSED ================= --}}
    <div class="hidden in-data-flux-sidebar-collapsed-desktop:block space-y-1">

      @foreach($sidebarGroups as $group)
      <x-sidebar-group-collapsed
                      :linkgroup="$group['linkgroup']"
                       :icongroup="$group['icongroup']"
                       :headingroup="$group['headingroup']"
                       :elements="$group['elements']"
      />
    @endforeach
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
