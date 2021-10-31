<?php

namespace App\Http\Livewire\Dashboard\Interests;

use Livewire\Component;
use App\Models\Interest;
use Livewire\WithFileUploads;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Update extends Component
{
    use WithFileUploads;
    use AuthorizesRequests;

    public $interest;
    public $icon;

    protected $rules = [
        'interest.name' => 'required|min:2|max:100',
        'interest.status' => 'required',
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
        $this->authorize('edit interests');

        $validatedData = $this->validate();

        $this->interest->save();

        if ($this->icon) {
            $this->interest->update([
                'icon' => uploadToPublic('interests', $validatedData['icon']),
            ]);
        }
        session()->flash('alert', __('Update Successfully.'));

        return redirect()->route('admin.interests.index');
    }

    public function mount(Interest $interest)
    {
        $this->interest = $interest;
    }
    public function render()
    {
        return view('livewire.dashboard.interests.update');
    }
}
