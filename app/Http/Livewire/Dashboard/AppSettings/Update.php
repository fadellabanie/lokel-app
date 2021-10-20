<?php

namespace App\Http\Livewire\Dashboard\AppSettings;

use Livewire\Component;
use App\Models\AppSetting;
use Livewire\WithFileUploads;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Update extends Component
{
    use WithFileUploads;
    use AuthorizesRequests;

    public $appSetting;

    protected $rules = [
        'appSetting.facebook' => 'required',
        'appSetting.twitter' => 'required',
        'appSetting.instagram' => 'required',
        'appSetting.snapchat' => 'required',
        'appSetting.whats_app' => 'required',
        'appSetting.email' => 'required|email',
    ];

    public function submit()
    {
        $this->validate();

        $this->appSetting->save();

        session()->flash('alert', __('Update Successfully.'));
    }

    public function mount()
    {
        $this->appSetting = AppSetting::first();
    }

    public function render()
    {
        return view('livewire.dashboard.app-settings.update');
    }
}
