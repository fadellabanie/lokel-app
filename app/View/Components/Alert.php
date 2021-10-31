<?php

namespace App\View\Components;

use Illuminate\Support\Arr;
use Illuminate\View\Component;

class Alert extends Component
{
    /** @var string */
    public $type;

    public function __construct($type = 'alert')
    {
        $this->type = $type;
    }

    public function message()
    {
        return (string) Arr::first($this->messages());
    }

    public function messages()
    {
        return (array) session()->get($this->type);
    }

    public function exists(): bool
    {
        return session()->has($this->type) && !empty($this->messages());
    }

    public function render()
    {
        return view('components.alert');
    }
}
