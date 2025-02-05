<?php

use Illuminate\Support\Facades\Route;

Route::patch(
    '{resource}/{resourceId}/reorder',
    'CoeliacSanctuary\NovaFieldSortable\Http\Controllers\ResourceSortingController@handle'
);
