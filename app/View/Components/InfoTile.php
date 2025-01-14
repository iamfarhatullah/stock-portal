<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InfoTile extends Component
{
    public $icon;
    public $count;
    public $title;

    public function __construct($icon, $count, $title)
    {
        $this->icon = $icon;
        $this->count = $count;
        $this->title = $title;
    }

    public function render()
    {
        return view('components.info-tile');
    }
}
