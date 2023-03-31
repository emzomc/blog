<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Area;

class AreaDropdown extends Component
{
    public function render()
    {
        return view('components.area-dropdown', [
            'areas' => Area::all(),
            'currentArea' => Area::firstWhere('area_slug', request('area'))
        ]);
    }
}
