<?php

namespace App\Http\Controllers;

use App\Brand;
use App\CarModel;
use App\Sale;
use App\Color;
use App\ResponseList;
use Illuminate\Http\Request;

class CarModelController extends Controller
{
        public function create(Request $request)
        {
                $carmodel = new CarModel();

                $rawBody = $request->json()->all();
                $carmodel->name = $rawBody['name'];
                $carmodel->description = $rawBody['description'];

                $carmodel->save();
                return response()->json($carmodel);
        }

        public function update(Request $request, $id)
        {
                $carmodel = CarModel::findOrFail($id);

                $rawBody = $request->json()->all();

                $carmodel->name = $rawBody['name'];
                $carmodel->description = $rawBody['description'];

                $carmodel->save();

                return response()->json($carmodel);
        }

        public function getById($id)
        {
                $carmodel = CarModel::findOrFail($id);

                if (!$carmodel) {
                        return response()->json('not found', 404);
                }

                return response()->json($carmodel);
        }

        public function getList(Request $request)
        {
                // offset from 0
                $offset = $request->offset;
                $pageSize = $request->pageSize;

                $count = CarModel::count();
                $skip = $pageSize * $offset;

                $carmodels = CarModel::orderBy('name', 'desc')
                        ->skip($skip)
                        ->take($pageSize)
                        ->get();

                if (is_null($carmodels)) {
                        return response()->json('not found', 404);
                }

                //TODO: filter

                $responseList = new ResponseList();
                $responseList->data = $carmodels;
                $responseList->offset = $offset;
                $responseList->pageSize = $pageSize;
                $responseList->count = $count;

                return response()->json($responseList);
        }
}
