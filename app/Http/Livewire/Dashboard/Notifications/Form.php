<?php

namespace App\Http\Livewire\Dashboard\Notifications;

use App\Models\User;
use App\Models\Captain;
use Livewire\Component;
use App\Models\Passenger;
use App\Models\GeneralNotification;
use App\Models\NotificationFireBase;
use App\Http\Interfaces\Senders\SenderFactory;
use App\Http\Traits\Notification as NotificationTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Form extends Component
{
    use NotificationTrait;
    use AuthorizesRequests;
    use AuthorizesRequests;

    public $type;
    public $title;
    public $content;
    public $user;

    protected $rules = [
        'type' => 'required',
        'title' => 'required_if:type,firebase-notification|min:2|max:150',
        'content' => 'required|min:3|max:1000',
        'user' => 'required',

    ];



    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function resetForm()
    {
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function submit()
    {
        //$this->authorize('send notifications');
        $validatedData = $this->validate();
       
        $user = User::find($validatedData['user']);

        $senderFactory = new SenderFactory();

        if ($validatedData['type'] == 'sms') {
            $senderFactory->initialize('sms', $user->mobile, $validatedData['content']);
        } elseif ($validatedData['type'] == 'firebase-notification') {
            $senderFactory->initialize('firebase-notification', $user->device_token, $validatedData['content'], $validatedData['title']);
        }elseif ($validatedData['type'] == 'email') {
            $senderFactory->initialize('email', $user->email, $validatedData['content']);
        }

        $this->resetForm();

        session()->flash('alert', __('Sending Successfully.'));

        return redirect()->route('admin.notifications.index');
    }

    public function render()
    {
        return view('livewire.dashboard.notifications.form', [
            'members' =>  User::select('id', 'name', 'mobile')->get(),

        ]);
    }
}
