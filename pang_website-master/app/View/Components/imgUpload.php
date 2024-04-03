<?php

namespace App\View\Components;

use Illuminate\View\Component;

class imgUpload extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $labelName; 
    public $btnName;
    public $inputName;
    public $screenMode;
    public $list;
    public $attr;


    public function __construct($labelName, $btnName="上传照片", $inputName="image_path[]", $screenMode, $list='', $attr='image_path')
    {
        $this->labelName = $labelName;
        $this->btnName = $btnName;
        $this->inputName = $inputName;
        $this->screenMode = $screenMode;
        $this->list = $list;
        $this->attr = $attr;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.img-upload');
    }
}
