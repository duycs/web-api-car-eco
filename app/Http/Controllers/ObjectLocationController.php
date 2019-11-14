<?php

namespace App\Http\Controllers;

use App\ObjectLocation;
use App\ResponseList;
use Illuminate\Http\Request;

class ObjectLocationController extends Controller
{
        public function create(Request $request)
        {
                $objectLocation = new ObjectLocation();

                $rawBody = $request->json()->all();
                $objectLocation->object_type_id = $rawBody['object_type_id'];
                $objectLocation->object_detail_id = $rawBody['object_detail_id'];
                $objectLocation->location_id = $rawBody['location_id'];
                $objectLocation->rating_number = $rawBody['rating_number'];
                $objectLocation->description = $rawBody['description'];

                $objectLocation->save();
                return response()->json($objectLocation);
        }

        public function update(Request $request, $id)
        {
                $objectLocation = ObjectLocation::findOrFail($id);

                $rawBody = $request->json()->all();

                $objectLocation->object_type_id = $rawBody['object_type_id'];
                $objectLocation->object_detail_id = $rawBody['object_detail_id'];
                $objectLocation->location_id = $rawBody['location_id'];
                $objectLocation->rating_number = $rawBody['rating_number'];
                $objectLocation->description = $rawBody['description'];

                $objectLocation->save();

                return response()->json($objectLocation);
        }

        public function getById($id)
        {
                $objectLocation = ObjectLocation::findOrFail($id);

                if (!$objectLocation) {
                        return response()->json('not found', 404);
                }

                return response()->json($objectLocation);
        }

        public function getList(Request $request)
        {
                // offset from 0
                $offset = $request->offset;
                $pageSize = $request->pageSize;

                $count = ObjectLocation::count();
                $skip = $pageSize * $offset;

                $objectLocations = ObjectLocation::orderBy('rating_number', 'desc')
                        ->skip($skip)
                        ->take($pageSize)
                        ->get();

                if (!$objectLocations) {
                        return response()->json('not found', 404);
                }

                //TODO: filter

                $responseList = new ResponseList();
                $responseList->data = $objectLocations;
                $responseList->offset = $offset;
                $responseList->pageSize = $pageSize;
                $responseList->count = $count;

                return response()->json($responseList);
        }
}
