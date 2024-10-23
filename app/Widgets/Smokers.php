<?php

namespace App\Widgets;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Widgets\BaseDimmer;

class Smokers extends BaseDimmer
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $count = \App\Information::where('smoker','active')->count();
        $string = 'Active Smokers';

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-fire',
            'title'  => "{$count} {$string}",
            'text'   => '',
            'button' => [
                'text' => 'Smokers',
                'link' => route('voyager.information.index'),
            ],
            'image' => '\smoker.jfif',
        ]));
    }

    /**
     * Determine if the widget should be displayed.
     *
     * @return bool
     */
    public function shouldBeDisplayed()
    {
        return Auth::user()->can('browse', Voyager::model('Post'));
    }
}
