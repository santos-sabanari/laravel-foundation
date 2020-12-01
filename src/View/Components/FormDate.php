<?php

namespace SantosSabanari\LaravelFoundation\View\Components;

use ProtoneMedia\LaravelFormComponents\Components\Component;
use ProtoneMedia\LaravelFormComponents\Components\HandlesDefaultAndOldValue;
use ProtoneMedia\LaravelFormComponents\Components\HandlesValidationErrors;

class FormDate extends Component
{
    use HandlesValidationErrors, HandlesDefaultAndOldValue;

    public string $name;
    public string $label;
    public string $type;

    public $value;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        string $name,
        string $label = '',
        string $type = 'text',
        $bind = null,
        $default = null,
        $language = null,
        bool $showErrors = true
    ) {
        $this->name       = $name;
        $this->label      = $label;
        $this->type       = $type;
        $this->showErrors = $showErrors;

        if ($language) {
            $this->name = "{$name}[{$language}]";
        }

        $this->setValue($name, $bind, $default, $language);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('laravel-foundation::components.fields.form-date');
    }
}
