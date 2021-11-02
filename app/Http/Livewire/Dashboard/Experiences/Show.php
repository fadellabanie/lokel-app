<?php

namespace App\Http\Livewire\Dashboard\Experiences;

use Livewire\Component;
use App\Models\Experience;

class Show extends Component
{
    public $experience;

    public function mount(Experience $experience)
    {
        $this->experience = $experience;
    }
    public function render()
    {
        return view('livewire.dashboard.experiences.show');
    }
}
