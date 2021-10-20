<?php

namespace App\Http\Livewire\Dashboard\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Services\SubscriptionService;
use Illuminate\Support\Facades\Hash;

class Store extends Component
{
    use WithFileUploads;

    public $name, $email, $mobile,$whatsapp_mobile,$trading_certification;
    public $password, $country_code, $city_id,$avatar;
    public $type;

    protected $rules = [
        'name' => 'required|min:4|max:100',
        'type' =>  'required|in:personal,company',
        'trading_certification' =>  'required_if:type,company',
        'email' =>  'required|unique:users,email',
        'mobile' =>  'required|unique:users,mobile',
        'whatsapp_mobile' =>  'required|unique:users,whatsapp_mobile',
        'password' => 'required|min:8|max:15',
        'country_code' => 'required',
        'city_id' => 'required',
        'avatar' => 'required',
    ];
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submit()
    {
        $validatedData = $this->validate();
       
        $validatedData['avatar'] = ($this->avatar) ? uploadToPublic('users', $validatedData['avatar']) : "";
        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['verified_at'] = now();
        
       $user = User::create($validatedData);

        $request['package_id'] = $user->package_id;
        $request['user_id'] = $user->id;
        SubscriptionService::subscription($request);
        
        $this->reset();

        session()->flash('alert', __('Saved Successfully.'));
        return redirect()->route('admin.users.index');

    }

    public function resetForm()
    {
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }
   
    
    public function render()
    {
        return view('livewire.dashboard.users.store');
    }
}
