<?php

  use Livewire\Component;

  new class extends Component
  {
    public $count = 0;
    public function increment ()
    {
      return $this->count++;
    }

    public function decrement()
    {
      return $this->count--;
    }

    public function resume()
    {
      return $this->count = 0;
    }
  };
