<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DefaultLayout extends AbstractLayout
{
    /**
     * Create a new component instance.
     */
    public function __construct(public string $title ='')
    {
        $this->title = config('app.name') . ($title ? "|$title" : '') ;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('layout.default');
    }
}
