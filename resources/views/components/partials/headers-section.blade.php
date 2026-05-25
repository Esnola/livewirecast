<flux:header sticky container
             class="bg-white dark:bg-zinc-800 border-b border-zinc-200 dark:border-zinc-600 sticky -top-50">

  <flux:sidebar.toggle class="lg:hidden" icon="bars-2"/>
  <flux:navbar class="max-lg:hidden -mb-px">
    @isset($title)
      <flux:badge variant="subtle" icon="home"
                  class="text-lg absolute -top-6 -left-4 px-4 py-1 rounded-xl  w-fit border border-gray-600/30 bg-gray-300/10!">{{$title}}</flux:badge>
    @endisset
    <flux:navbar.item href="#">Dashboard</flux:navbar.item>
    <flux:navbar.item href="{{route('order.index')}}" badge="{{$this->counters()['orders']}}">Orders
    </flux:navbar.item>
    <flux:navbar.item href="{{route('product.index')}}" badge="{{$this->counters()['products']}}">Products
    </flux:navbar.item>
  </flux:navbar>
</flux:header>


<flux:sidebar collapsible="mobile"
              class="lg:hidden bg-zinc-50 dark:bg-zinc-900 border-r border-zinc-200 dark:border-zinc-700">
  <flux:sidebar.toggle class="lg:hidden" icon="x-mark"/>

  <flux:sidebar.nav>
    <flux:sidebar.item href="#" data-current>Dashboard</flux:sidebar.item>
    <flux:sidebar.item href="#" badge="32">Orders</flux:sidebar.item>
    <flux:sidebar.item href="#">Catalog</flux:sidebar.item>
    <flux:sidebar.item href="#">Configuration</flux:sidebar.item>
  </flux:sidebar.nav>
</flux:sidebar>
