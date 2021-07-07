<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DropdownLiAEdit extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $link;
    public $title;
    
    public function __construct($link, $title)
    {
        //
        $this->link = $link;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dropdown-li-a-edit');
    }
}
