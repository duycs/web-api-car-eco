<?php

namespace App\Http\Controllers;

use App\Brand;
use App\ResponseList;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function create(Request $request)
    {
        $brand = new Brand();

        $rawBody = $request->json()->all();
        $brand->name = $rawBody['name'];
        $brand->order_number = $rawBody['order_number'];
        $brand->description = $rawBody['description'];

        $brand->save();
        return response()->json($brand);
    }

    public function update(Request $request, $id)
    {
        $brand = Brand::findOrFail($id);

        // if (isset($brand)) {
        //         return response()->json('not found', 404);
        // }

        $rawBody = $request->json()->all();

        $brand->name = $rawBody['name'];
        $brand->order_number = $rawBody['order_number'];
        $brand->description = $rawBody['description'];
        // if (!isset($rawBody->input('name'))) {
        //         $brand->name = $rawBody->input('name');
        // }

        // if (!isset($rawBody['description'])) {
        //         $brand->description = $rawBody->input('description');
        // }

        $brand->save();

        return response()->json($brand);
    }

    public function getById($id)
    {
        $brand = Brand::findOrFail($id);

        if (is_null($brand)) {
            return response()->json('not found', 404);
        }

        return response()->json($brand);
    }

    public function getList(Request $request)
    {
        // offset from 0
        $offset = $request->offset;
        $pageSize = $request->pageSize;

        $count = Brand::count();
        $skip = $pageSize * $offset;

        $brands = Brand::orderBy('name', 'desc')
            ->skip($skip)
            ->take($pageSize)
            ->get();

        if (is_null($brands)) {
            return response()->json('not found', 404);
        }

        //TODO: filter

        $responseList = new ResponseList();
        $responseList->data = $brands;
        $responseList->offset = $offset;
        $responseList->pageSize = $pageSize;
        $responseList->count = $count;

        return response()->json($responseList);
    }
}
