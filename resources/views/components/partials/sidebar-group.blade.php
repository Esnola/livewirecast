<flux:sidebar.group
        expandable
        :expanded="request()->routeIs($linkgroup)"
        :icon="$icongroup"
        :heading="$headingroup"
        class="sidebar-group">

  @foreach($elements as $element)
    <flux:sidebar.item
            badge="{{ $element['counter'] ?? '' }}"
            href="{{ $element['link'] ? route($element['link']) : '#' }}"
            icon="{{ $element['icon'] }}"
            :current="request()->routeIs($element['link'])"
            class="sidebar-item dark:bg-transparent! dark:text-white!  data-current:bg-zinc-300! dark:data-current:bg-zinc-600! dark:hover:bg-zinc-600!">
      {{ $element['title'] }}
    </flux:sidebar.item>
  @endforeach

</flux:sidebar.group>
