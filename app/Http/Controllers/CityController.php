<?php

namespace App\Http\Controllers;

use App\City;
use App\ResponseList;
use Illuminate\Http\Request;

class CityController extends Controller
{
        /**
         * @SWG\Post(
         *     path="/api/cities",
         *     description="Return a city after created",
         *     @SWG\Parameter(
         *         name="name",
         *         in="query",
         *         type="string",
         *         description="name",
         *         required=true,
         *     ),
         *     @SWG\Parameter(
         *         name="code",
         *         in="query",
         *         type="string",
         *         description="code",
         *         required=true,
         *     ),
         *     @SWG\Response(
         *         response=200,
         *         description="OK",
         *     ),
         *     @SWG\Response(
         *         response=422,
         *         description="Missing Data"
         *     )
         * )
         */
        public function create(Request $request)
        {
                $city = new City();

                $rawBody = $request->json()->all();
                $city->name = $rawBody['name'];
                $city->code = $rawBody['code'];

                $city->save();
                return response()->json($city);
        }

        public function update(Request $request, $id)
        {
                $city = City::findOrFail($id);

                // if (isset($city)) {
                //         return response()->json('not found', 404);
                // }

                $rawBody = $request->json()->all();

                $city->name = $rawBody['name'];
                $city->code = $rawBody['code'];
                // if (!isset($rawBody->input('name'))) {
                //         $city->name = $rawBody->input('name');
                // }

                // if (!isset($rawBody['code'])) {
                //         $city->code = $rawBody->input('code');
                // }

                $city->save();

                return response()->json($city);
        }

        public function getById($id)
        {
                $city = City::findOrFail($id);

                if (is_null($city)) {
                        return response()->json('not found', 404);
                }

                return response()->json($city);
        }

        public function getList(Request $request)
        {
                // offset from 0
                $offset = $request->offset;
                $pageSize = $request->pageSize;

                $count = City::count();
                $skip = $pageSize * $offset;

                $cities = City::orderBy('name', 'desc')
                        ->skip($skip)
                        ->take($pageSize)
                        ->get();

                if (is_null($cities)) {
                        return response()->json('not found', 404);
                }

                //TODO: filter

                $responseList = new ResponseList();
                $responseList->data = $cities;
                $responseList->offset = $offset;
                $responseList->pageSize = $pageSize;
                $responseList->count = $count;

                return response()->json($responseList);
        }
}
