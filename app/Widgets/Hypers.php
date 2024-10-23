<?php

namespace App\Widgets;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Widgets\BaseDimmer;

class Hypers extends BaseDimmer
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
        $count = \App\Information::where('hyper','yes')->count();
        $string = 'With Hypertension';

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-plug',
            'title'  => "{$count} {$string}",
            'text'   => '',
            'button' => [
                'text' => 'With Hypertension',
                'link' => route('voyager.information.index'),
            ],
            'image' => '\hyper.jfif',
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
