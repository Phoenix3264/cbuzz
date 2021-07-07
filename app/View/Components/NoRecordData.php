<?php

namespace App\View\Components;

use Illuminate\View\Component;

class NoRecordData extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $col;

    public function __construct($col)
    {
        //
        $this->col = $col;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.no-record-data');
    }
}
