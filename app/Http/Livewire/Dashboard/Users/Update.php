<?php

namespace App\Http\Livewire\Dashboard\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;

class Update extends Component
{
    use WithFileUploads;

    public $user;
    public $avatar;
    public $type;
    public $password;
    public $city_id;

    protected function rules()
    {
        return [
            'user.name' => 'required|min:4|max:100',
            'type' =>  'required|in:admin,personal,company',
            'user.trading_certification' =>  'required_if:type,company',
            'user.email' => 'required|string|email|unique:users,email,' . $this->user->id,
            'user.mobile' =>  'required|unique:users,mobile,' . $this->user->id,
            'user.whatsapp_mobile' =>  'required|unique:users,whatsapp_mobile,' . $this->user->id,
            'password' => 'nullable|min:8|max:15',
            'user.country_code' => 'required',
            'city_id' => 'required',
        ];
    }

    public function updatedIcon()
    {
        $this->validate([
            'avatar' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);
    }

    public function submit()
    {
       $validatedData = $this->validate();
       // dd($validatedData['password']);
        $this->user->save();

        if($this->password) {
            $this->user->update([ 
               'password' => Hash::make($validatedData['password']),
            ]);
        }

        if ($this->avatar) {
            $this->user->update([
                'avatar' => uploadToPublic('users',$validatedData['avatar']),
            ]);
        }

        session()->flash('alert', __('Update Successfully.'));

        return redirect()->route('admin.users.index');
    }

    public function mount(User $user)
    {
        $this->user = $user;
        $this->type = $user->type;
        $this->country_code = $user->country_code;
        $this->city_id = $user->city_id;
    }
    public function render()
    {
        return view('livewire.dashboard.users.update');
    }
}
