<?php

  use App\Models\Product;
  use Livewire\Attributes\Computed;
  use Livewire\Attributes\Title;
  use Livewire\Component;
  use App\Enums\ProductEnum;

  new #[Title('Elements Refs - Chapter 20')]
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
  <form wire:submit="save"
        class="w-2/4 space-y-6"
        action="{{ route('product.img_upload') }}"
        method="POST"
        enctype="multipart/form-data">
    <flux:input wire:model="name" label="Title" placeholder="Title" class="w-full"/>
    <flux:textarea class="w-full"
                   wire:ref="description"
                   wire:model="description" label="Content"
                   placeholder="Write multi lines here to see this text area height change..."/>

    <flux:radio.group wire:model="status" label="Status" variant="cards" class="max-sm:flex-col gap-4">
      @foreach($this->statuses as $status)
        <flux:radio
                class="{{ $status->badgeClass()}} cursor-pointer"
                :value="$status->value"
                :label="$status->label()"
                :icon="$status->icon()"
        />
      @endforeach
    </flux:radio.group>

    <div class="flex justify-center mt-12">
      <flux:button type="submit"
                   variant="primary">
        <flux:icon.loading variant="solid" class="not-in-data-loading:hidden"/>
        Create Post
      </flux:button>
    </div>
  </form>


</div>
<script>
    let textarea = this.$refs.description

    autoSizeTextarea(textarea)

    textarea.addEventListener('input', () => autoSizeTextarea(textarea))

    function autoSizeTextarea(el) {
        let style = window.getComputedStyle(el)
        let borderTop = parseFloat(style.borderTopWidth) || 0
        let borderBottom = parseFloat(style.borderBottomWidth) || 0

        el.style.height = 'auto'
        el.style.height = (el.scrollHeight + borderTop + borderBottom) + 'px'
    }
</script>
