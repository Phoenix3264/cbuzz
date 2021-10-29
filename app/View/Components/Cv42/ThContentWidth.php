<?php

namespace App\View\Components\Cv42;

use Illuminate\View\Component;

class ThContentWidth extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $title;
    public $width;

    public function __construct($title, $width)
    {
        //
        $this->title = $title;
        $this->width = $width;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.cv42.th-content-width');
    }
}
