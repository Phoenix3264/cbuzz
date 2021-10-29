<?php

namespace App\View\Components\Cv42;

use Illuminate\View\Component;

class ButtonSubmitDanger extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.cv42.button-submit-danger');
    }
}
