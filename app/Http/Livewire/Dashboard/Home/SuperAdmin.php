<?php

namespace App\Http\Livewire\Dashboard\Home;

use Livewire\Component;

class SuperAdmin extends Component
{

    public $unReviewOrders;
    public $unReviewRealEstates;
    public $totalRealEstates;
    public $totalOrders;

    public function mount()
    {
     
    }
    public function render()
    {
        return view('livewire.dashboard.home.super-admin');
    }
}
