<?php

  use App\Models\Product;
  use Livewire\Attributes\Computed;
  use Livewire\Attributes\Title;
  use Livewire\Component;
  use App\Enums\ProductEnum;

  new #[Title('Interceptors - Chapter 24')]
  class extends Component {
    public string $name = '';
    public string $description = '';
    public string $status;


    public function save()
    {
      //sleep(1);
      Product::create($this->validate([
        'name' => 'required|min:3',
        'description' => 'required',
        'status' => 'required'
      ]));
      $this->redirect('/');
    }


    #[Computed]
    public function statuses(): array
    {
      return ProductEnum::cases();
    }
  }

?>
<div>
  <form wire:submit="save" class="w-96 space-y-6">
    <flux:input wire:model="name" label="Title" placeholder="Title" class="w-full"/>
    <flux:input wire:model="description" label="Content" placeholder="Write here..." class="w-full"/>

    <flux:radio.group wire:model="status" label="Status" variant="cards" class="max-sm:flex-col gap-4 ">
      @foreach($this->statuses as $status)
        <flux:radio
                class="{{ $status->badgeClass()}} min-h-30"
                :value="$status->value"
                :label="$status->label()"
                :icon="$status->icon()"
        />
      @endforeach

    </flux:radio.group>
    <div class="flex justify-center mt-12">
      <flux:button type="submit" variant="primary">
        <flux:icon.loading variant="solid" class="not-in-data-loading:hidden"/>
        Create Post
      </flux:button>
    </div>
  </form>


</div>
