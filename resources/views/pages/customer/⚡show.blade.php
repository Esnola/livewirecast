<?php

  use App\Models\User;
  use Livewire\Component;

  new class extends Component {
    public User $customer;


  };
?>

<div>
  {{ $customer->name }} {{ $customer->last_name }}
</div>
