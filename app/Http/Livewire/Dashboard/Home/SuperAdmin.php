<?php

namespace App\Http\Livewire\Dashboard\Home;

use App\Models\Captain;
use App\Models\Experience;
use App\Models\Passenger;
use Livewire\Component;

class SuperAdmin extends Component
{

    public $totalPassengers;
    public $totalCaptains;
    public $totalPendingExperiences;
    public $totalAcceptExperiences;

    public function mount()
    {
        $this->totalPendingExperiences = Experience::Pending()->count();
        $this->totalAcceptExperiences = Experience::Accept()->count();
        $this->totalCaptains = Captain::count();
        $this->totalPassengers = Passenger::count();
    }
    public function render()
    {
        return view('livewire.dashboard.home.super-admin');
    }
}
