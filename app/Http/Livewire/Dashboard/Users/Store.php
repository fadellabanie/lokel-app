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

    public $name, $email, $mobile;
    public $password,$avatar;

    protected $rules = [
        'name' => 'required|min:4|max:100',
        'email' =>  'required|unique:users,email',
        'mobile' =>  'required|unique:users,mobile',
        'password' => 'required|min:8|max:15',
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
        
       User::create($validatedData);
        
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
