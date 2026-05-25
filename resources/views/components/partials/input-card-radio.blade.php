@props([
  'value' => '',
  'label' => 'Published',
  'description' => 'Descripción de prueba',
  'icon' => 'pencil-square',
  'checked' => '',
 'class' => '',
 'name'=>  'name'
  ])

<div>
  <div class="flex items-start justify-between w-fit max-w-60 border rounded-md p-3 gap-4 {{ $class }}">
    <flux:icon name="{{ $icon }}" class="ml-3 shrink-0 text-zinc-500 size-"/>
    <div class="flex flex-col gap-1" >
      <h3 class="text-sm font-semibold flex-1">{{ $label }}</h3>
      <p class="text-xs flex-1">{{ $description }}</p>
    </div>
    <input type="radio" value="{{ $value  }}"
           role="radio"
           aria-checked="{{ $checked }}" {{$checked}} name="{{ $name }}"  />
  </div>

</div>
