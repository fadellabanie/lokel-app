<?php

namespace App\Http\Livewire\Dashboard\RealEstates;

use Livewire\Component;
use App\Models\RealEstate;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Update extends Component
{
    use WithFileUploads;
    use AuthorizesRequests;

    public $realEstate;
    public $images = [];

    protected $rules = [
        'realEstate.name' => 'required',
        'realEstate.type' => 'required',
        'realEstate.realestate_type_id' => 'required|exists:realestate_types,id',
        'realEstate.contract_type_id' => 'required|exists:contract_types,id',
        'realEstate.view_id' => 'required|exists:views,id',
        'realEstate.price' => 'required|gt:0',
        'realEstate.space' => 'required|gt:0',
        'realEstate.city_id' => 'required',
        'realEstate.country_id' => 'required',
        'realEstate.number_building' => 'required|gt:0',
        'realEstate.age_building' => 'required|gt:0',
        'realEstate.street_width' => 'required|gt:0',
        'realEstate.street_number' => 'required|gt:0',
        'realEstate.video_url' => 'nullable',
        'realEstate.type_of_owner' => 'required',
        'realEstate.number_card' => 'required',
        'realEstate.neighborhood' => 'nullable',
        'realEstate.elevator' => 'required',
        'realEstate.parking' => 'required',
        'realEstate.ac' => 'required',
        'realEstate.note' => 'nullable',
        'realEstate.furniture' => 'required',
        'realEstate.lat' =>  ['required', 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
        'realEstate.lng' => ['required', 'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
        'realEstate.address' => 'required',
        'images.*' => 'nullable',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedIcon()
    {
        $this->validate([
            'images.*' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);
    }

    public function submit()
    {
        $this->authorize('edit real estates');

        $validatedData = $this->validate();
       // dd($validatedData);

        if ($this->images) {
            foreach ($validatedData['images'] as $image) {
                DB::table('realestate_media')->insert([
                    'realestate_id' => $this->realEstate->id,
                    'image' => uploadToPublic('real-estates', $image),
                ]);
            }
        }

        $this->realEstate->save();

        session()->flash('alert', __('Update Successfully.'));

        return redirect()->route('admin.real-estates.index');
    }

    public function mount(RealEstate $realEstate)
    {
        $this->realEstate = $realEstate;
    }
    public function render()
    {
        return view('livewire.dashboard.real-estates.update');
    }
}
