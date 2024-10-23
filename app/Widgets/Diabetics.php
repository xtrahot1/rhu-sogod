<?php

namespace App\Widgets;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Widgets\BaseDimmer;

class Diabetics extends BaseDimmer
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
        $count = \App\Information::where('diabetic','yes')->count();
        $string = 'Diabetics';

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-droplet',
            'title'  => "{$count} {$string}",
            'text'   => '',
            'button' => [
                'text' => 'Diabetics',
                'link' => route('voyager.information.index'),
            ],
            'image' => '\sus.jfif',
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
