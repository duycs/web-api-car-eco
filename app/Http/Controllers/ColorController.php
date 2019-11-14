<?php

namespace App\Http\Controllers;

use App\Color;
use App\ResponseList;
use Illuminate\Http\Request;

class ColorController extends Controller
{
        public function create(Request $request)
        {
                $color = new Color();

                $rawBody = $request->json()->all();
                $color->name = $rawBody['name'];
                $color->code = $rawBody['code'];

                $color->save();
                return response()->json($color);
        }

        public function update(Request $request, $id)
        {
                $color = Color::findOrFail($id);

                $rawBody = $request->json()->all();

                $color->name = $rawBody['name'];
                $color->code = $rawBody['code'];

                $color->save();

                return response()->json($color);
        }

        public function getById($id)
        {
                $color = Color::findOrFail($id);

                if (is_null($color)) {
                        return response()->json('not found', 404);
                }

                return response()->json($color);
        }

        public function getList(Request $request)
        {
                // offset from 0
                $offset = $request->offset;
                $pageSize = $request->pageSize;

                $count = Color::count();
                $skip = $pageSize * $offset;

                $colors = Color::orderBy('name', 'desc')
                        ->skip($skip)
                        ->take($pageSize)
                        ->get();

                if (is_null($colors)) {
                        return response()->json('not found', 404);
                }

                //TODO: filter

                $responseList = new ResponseList();
                $responseList->data = $colors;
                $responseList->offset = $offset;
                $responseList->pageSize = $pageSize;
                $responseList->count = $count;

                return response()->json($responseList);
        }
}
