<?php

  use App\Models\User;
  use Livewire\Component;

  new class extends Component {

    public function users()
    {
      return User::with('buys')->get();
    }
  };
?>

<div>
  @foreach ($this->users() as $customer)
    <div class="">{{ $customer->name }} {{ $customer->last_name }}</div>
  @endforeach
</div>
