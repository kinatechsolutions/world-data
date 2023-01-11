<?php

namespace Kinatech\World\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Kinatech\World\Facade\World;

class WorldDataController extends Controller
{
    public int $perPage;

    public function __construct()
    {
        $this->perPage = env('WORLD_PER_PAGE_PAGINATION', 100);
    }

    public function index(Request $request, $model, $model_id = null): JsonResponse
    {
        $query = World::$model();

        if ($model_id)
            $query->whereId($model_id);

        if ($request->has('with'))
            $query->with($request->get('with'));

        $data = $query->cursorPaginate($request->get('per_page') ?: $this->perPage);

        return response()->json([
            'data' => $data,
        ], 200);
    }
}

