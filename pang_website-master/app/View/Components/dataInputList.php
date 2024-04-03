<?php

namespace App\View\Components;

use Illuminate\View\Component;

class dataInputList extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

     public $labelFor;
     public $labelName;
     public $lists;
     public $attr;
     public $selected;
     public $required;

    public function __construct($labelFor,$labelName,$lists,$attr,$selected="", $required = "")
    {
        $this->labelFor = $labelFor;
        $this->labelName = $labelName;
        $this->lists = $lists;
        $this->attr = $attr;
        $this->selected = $selected;
        $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.data-input-list');
    }
}
