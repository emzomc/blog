<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Area;

class LocationDropdown extends Component
{
    public function render()
    {
        return view('components.location-dropdown', [
            'areas' => Area::all(),
            'currentLocation' => Area::firstWhere('area_name', request('location'))
        ]);
    }
}
