<?php

namespace App\View\Components\Cv42;

use Illuminate\View\Component;

class WidgetImgLgRounded extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $link;

    public function __construct($link)
    {
        //
        $this->link = $link;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.cv42.widget-img-lg-rounded');
    }
}
