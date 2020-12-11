<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

abstract class Field extends Component
{
    public $name;
    public $value;
    public $label;
    public $class;
    public $options;
    public $optionsKey;
    public $optionsLabel;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $value = null, $label = null, $class = null, $options = null, $optionsKey = null, $optionsLabel = null)
    {
        $this->name     = $name;
        $this->value    = $value;
        $this->label    = $label;
        $this->class    = $class;
        $this->options  = $options;
        $this->optionsKey       = $optionsKey;
        $this->optionsLabel     = $optionsLabel;
    }

    abstract public function render();
}
