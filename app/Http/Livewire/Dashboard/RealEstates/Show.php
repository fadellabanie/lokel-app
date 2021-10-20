<?php

namespace App\Http\Livewire\Dashboard\RealEstates;

use Livewire\Component;
use App\Models\RealEstate;
use App\Http\Interfaces\Upgrades\UpgradeFactory;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Show extends Component
{
    use AuthorizesRequests;

    public $realEstate;
    public $data_id;
    public $type;
    public $end_date;

    protected $rules = [
        'type' => 'required',
        'end_date' => 'required|after:today',
    ];

    public function mount(RealEstate $realEstate)
    {
        $this->realEstate = RealEstate::with('user','medias')->whereId($realEstate->id)->first();
       // dd($this->realEstate);
    }


    public function conformPublish()
    {
        $this->emit('openPublishModal'); // Open model to using to jquery

    } 
     public function publish()
    {
        $validatedData = $this->validate();

        $upgradeFactory = new UpgradeFactory();
        $factory = $upgradeFactory->initialize($validatedData['type'], $this->realEstate->id,$validatedData['end_date']);

        $factory->upgrade();
        $this->emit('closePublishModal'); 
        session()->flash('alert', __('Publish Successfully.'));


    } 
    public function render()
    {
        return view('livewire.dashboard.real-estates.show');
    }
}
