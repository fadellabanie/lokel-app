<?php

namespace App\Http\Livewire\Dashboard\Countries;

use Livewire\Component;
use App\Models\Country;
use Livewire\WithFileUploads;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Update extends Component
{
    use WithFileUploads;
    use AuthorizesRequests;

    public $country;
    public $icon;

    protected $rules = [
        'country.ar_name' => 'required|min:4|max:100',
        'country.en_name' => 'required|min:4|max:100',
        'country.status' => 'required',
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
        $this->authorize('edit countries');

       $validatedData = $this->validate();

        $this->country->save();

        if ($this->icon) {
            
            $this->country->update([
                'icon' => uploadToPublic('countries',$validatedData['icon']),
            ]);
        }

        session()->flash('alert', __('Update Successfully.'));

        return redirect()->route('admin.countries.index');
    }

    public function mount(Country $country)
    {
        $this->country = $country;
    }
    public function render()
    {
        return view('livewire.dashboard.countries.update');
    }
}
