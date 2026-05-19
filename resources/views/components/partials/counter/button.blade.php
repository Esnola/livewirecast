<button wire:click="{{$action}}"
        @class(['px-4 py-2 flex-1 text-white transition-colors cursor-pointer',
                'bg-red-600  hover:bg-red-700' => $action === 'resume',
                'bg-blue-600  hover:bg-blue-700' => $action === 'decrement',
                'bg-green-600  hover:bg-green-700' => $action === 'increment',
])>
  {{ $label }}
</button>
