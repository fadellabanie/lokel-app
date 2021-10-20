<?php

namespace App\Http\Livewire\Dashboard\Admins;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class Store extends Component
{

    use WithFileUploads;

    public $name, $email, $mobile,$whatsapp_mobile;
    public $password, $country_code, $city_id,$avatar;
    public $role;

    protected $rules = [
        'name' => 'required|min:4|max:100',
        'role' =>  'required',
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
        $validatedData['type'] = 'admin';
        $validatedData['status'] = true;
        $validatedData['verified_at'] = now();
        
       $user = User::create($validatedData);
       
       $user->assignRole($validatedData['role']);

        $this->reset();

        session()->flash('alert', __('Saved Successfully.'));
        return redirect()->route('admin.admins.index');

    }

    public function resetForm()
    {
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }
    public function render()
    {
        return view('livewire.dashboard.admins.store',[
            'roles' => Role::get(),
        ]);
    }
}
