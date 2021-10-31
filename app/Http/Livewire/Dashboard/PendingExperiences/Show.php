<?php

namespace App\Http\Livewire\Dashboard\PendingExperiences;

use App\Models\Experience;
use Livewire\Component;

class Show extends Component
{
    public $experience;

    public function mount(Experience $experience)
    {
        $this->experience = $experience;
    }
    public function render()
    {
        return view('livewire.dashboard.pending-experiences.show');
    }
}
