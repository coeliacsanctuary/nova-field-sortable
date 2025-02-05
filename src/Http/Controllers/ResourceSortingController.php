<?php

namespace CoeliacSanctuary\NovaFieldSortable\Http\Controllers;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Routing\Controller;
use Laravel\Nova\Http\Requests\NovaRequest;

class ResourceSortingController extends Controller
{
    /**
     * @throws AuthorizationException
     */
    public function handle(NovaRequest $request)
    {
        $request->findResourceOrFail()->authorizeToUpdate($request);

        $direction = $request->get('direction');

        if (!in_array($direction, ['up', 'down'])) {
            return response(status: 500);
        }

        $model = $request->findModelQuery()->firstOrFail();

        if (!method_exists($model, 'moveOrderUp') || !method_exists($model, 'moveOrderDown')) {
            return response(__('Missing sorting methods on model :model', [
                'model' => get_class($model)
            ]), 500);
        }

        if ($direction == 'up') {
            $model->moveOrderUp();
        } else {
            $model->moveOrderDown();
        }

        return response(status: 200);
    }
}
