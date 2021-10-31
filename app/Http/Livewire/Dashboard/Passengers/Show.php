<?php

namespace App\Http\Livewire\Dashboard\Passengers;

use App\Models\Passenger;
use Livewire\Component;

class Show extends Component
{
    public $passenger;

    public function mount(Passenger $passenger)
    {
        $this->passenger = $passenger;
    }
    public function render()
    {
        return view('livewire.dashboard.passengers.show');
    }
}
