<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Property;

class FullPriceSlider extends Component
{
    public $min = Property::orderBy('lowest_price')->value('lowest_price');
    public $max = Property::orderBy('lowest_price', 'desc')->value('lowest_price');
    public $selected;

    public function __construct($min = 0, $max = 100, $selected = [])
    {
        $this->min = $min;
        $this->max = $max;
        $this->selected = $selected;
    }

    public function render()
    {
        return view(
            'components.full-price-slider',
            [
                'min' => $this->min,
                'max' => $this->max,
                'selected' => $this->selected,
            ]
        );
    }

}