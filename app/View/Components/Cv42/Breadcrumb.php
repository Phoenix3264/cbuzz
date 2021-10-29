<?php

namespace App\View\Components\Cv42;

use Illuminate\View\Component;

class Breadcrumb extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $link2;
    public $level2;
    public $level3;

    public function __construct($link2, $level2, $level3)
    {
        //
        $this->link2 = $link2;
        $this->level2 = $level2;
        $this->level3 = $level3;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.cv42.breadcrumb');
    }
}
