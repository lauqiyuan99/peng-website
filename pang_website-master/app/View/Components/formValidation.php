<?php

namespace App\View\Components;

use Illuminate\View\Component;

class formValidation extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */ 
    public $errorlist;
    public function __construct($errorlist)
    {
        $this->errorlist = $errorlist;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form-validation');
    }
}
