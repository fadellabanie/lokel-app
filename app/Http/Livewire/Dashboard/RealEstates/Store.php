<?php

namespace App\Http\Livewire\Dashboard\RealEstates;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\RealEstate;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Store extends Component
{
    use AuthorizesRequests;
    use WithFileUploads;

    public $realestate_type_id, $contract_type_id, $view_id, $price, $space;
    public $number_building, $age_building, $street_number, $street_width;
    public $video_url, $city_id, $country_id, $neighborhood;
    public $elevator = false;
    public $parking = false;
    public $ac = false;
    public $furniture = false;
    public $note, $lat, $lng, $address, $name, $type, $type_of_owner, $number_card;
    public $images = [];

    protected $rules = [
        'name' => 'required',
        'type' => 'required',
        'realestate_type_id' => 'required|exists:realestate_types,id',
        'contract_type_id' => 'required|exists:contract_types,id',
        'view_id' => 'required|exists:views,id',
        'price' => 'required|gt:0',
        'space' => 'required|gt:0',
        'city_id' => 'required',
        'country_id' => 'required',
        'number_building' => 'required|gt:0',
        'age_building' => 'required|gt:0',
        'street_width' => 'required|gt:0',
        'street_number' => 'required|gt:0',
        'video_url' => 'nullable',
        'type_of_owner' => 'required',
        'number_card' => 'required',
        'neighborhood' => 'nullable',
        'elevator' => 'required',
        'parking' => 'required',
        'ac' => 'required',
        'furniture' => 'required',
        'lat' =>  ['required', 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
        'lng' => ['required', 'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
        'address' => 'required',
        'images' => 'required',
        'images.*' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submit()
    {
        $this->authorize('create real estates');

        $validatedData = $this->validate();
        // dd($validatedData);
        $validatedData['user_id'] = 0;
        $validatedData['neighborhood'] =  $validatedData['neighborhood'] ??  $validatedData['address'];
        $validatedData['end_date'] = Carbon::now()->addDays(30);
        $validatedData['is_active'] = true;
        $validatedData['status'] = true;
        $validatedData['review_by'] = Auth::user()->id . "-" . Auth::user()->name;
        $validatedData['review_at'] = now();

        $realEstate = RealEstate::create($validatedData);

        foreach ($validatedData['images'] as $image) {
            DB::table('realestate_media')->insert([
                'realestate_id' => $realEstate->id,
                'image' => uploadToPublic('real-estates', $image),
            ]);
        }

        $this->reset();

        session()->flash('alert', __('Saved Successfully.'));

        return redirect()->route('admin.real-estates.index');
    }

    public function resetForm()
    {
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.dashboard.real-estates.store');
    }
}
