<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class KeyInfo extends Component
{
    /**
     * Create a new component instance.
     */
    public $keyPeoples;
    public function __construct(
        $keyPeoples = [],
    ) {
        $this->keyPeoples = $keyPeoples;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        // return view('components.key-info', ['key_peoples' => $this->key_peoples]);
        return view('components.key-info');
    }
}
