<?php

namespace App\Http\Livewire\Dashboard\Cities;

use App\Models\City;
use App\Models\Country;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Update extends Component
{
    use WithFileUploads;
    use AuthorizesRequests;

    public $city;
    public $icon;

    protected $rules = [
        'city.ar_name' => 'required|min:2|max:100',
        'city.en_name' => 'required|min:2|max:100',
        'city.country_id' => 'required',
        'city.status' => 'required',
        'icon' => 'nullable',
    ];

    public function updatedIcon()
    {
        $this->validate([
            'icon' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);
    }

    public function submit()
    {
        $this->authorize('edit cities');

        $validatedData = $this->validate();

        $this->city->save();

        if ($this->icon) {
            $this->city->update([
                'icon' => uploadToPublic('cities', $validatedData['icon']),
            ]);
        }
        session()->flash('alert', __('Update Successfully.'));

        return redirect()->route('admin.cities.index');
    }

    public function mount(City $city)
    {
        $this->city = $city;
    }
    public function render()
    {
        return view('livewire.dashboard.cities.update', [
            'countries' => Country::get(),
        ]);
    }
}
