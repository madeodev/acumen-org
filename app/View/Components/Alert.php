<?php

namespace App\View\Components;

use Roots\Acorn\View\Component;

class Alert extends Component
{
    /**
     * The alert type.
     *
     * @var string
     */
    public $type;

    /**
     * The alert message.
     *
     * @var string
     */
    public $message;

    /**
     * The alert types.
     *
     * @var array
     */
    public $types = [
        'default' => 'text-indigo-50 bg-indigo-400',
        'success' => 'text-cactus-50 bg-cactus-400',
        'caution' => 'text-daisy-50 bg-daisy-400',
        'warning' => 'text-cinnabar-50 bg-cinnabar-400',
    ];

    /**
     * Create the component instance.
     *
     * @param  string  $type
     * @param  string  $message
     * @return void
     */
    public function __construct($type = 'default', $message = null)
    {
        $this->type = $this->types[$type] ?? $this->types['default'];
        $this->message = $message;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return $this->view('components.alert');
    }
}
