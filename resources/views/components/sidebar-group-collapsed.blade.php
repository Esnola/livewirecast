<flux:dropdown>
  <flux:sidebar.item
          :icon="$icongroup"
          href="#"
          :current="request()->routeIs($linkgroup)"
           :tooltip=" $headingroup"
           class="sidebar-item"/>
  <flux:menu>
  @foreach($elements as $element)
    <flux:menu.item
            href="{{ $element['link'] ? route($element['link']) : '#' }}"
            class="sidebar-item flex items-center justify-between gap-2">

      <div class="flex items-center gap-x-2">
        <flux:icon name="{{ $element['icon'] }}"/>
        {{ $element['title'] }}  </div>
      {!!  $element['counter'] ? '<span class="px-1 py-0.5 rounded font-semibold bg-zinc-400 text-zinc-900">'. $element["counter"].' </span>' : "" !!}
    </flux:menu.item>
  @endforeach
  </flux:menu>
  </flux:dropdown>
