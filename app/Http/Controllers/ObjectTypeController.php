<?php

namespace App\Http\Controllers;

use App\ObjectType;
use App\Sale;
use App\ObjectLocation;
use App\ResponseList;
use Illuminate\Http\Request;

class ObjectTypeController extends Controller
{
        public function create(Request $request)
        {
                $objectType = new ObjectType();

                $rawBody = $request->json()->all();
                $objectType->name = $rawBody['name'];
                $objectType->description = $rawBody['description'];

                $objectType->save();
                return response()->json($objectType);
        }

        public function update(Request $request, $id)
        {
                $objectType = ObjectType::findOrFail($id);

                $rawBody = $request->json()->all();

                $objectType->name = $rawBody['name'];
                $objectType->description = $rawBody['description'];

                $objectType->save();

                return response()->json($objectType);
        }

        public function getById($id)
        {
                $objectType = ObjectType::findOrFail($id);

                if (is_null($objectType)) {
                        return response()->json('not found', 404);
                }

                return response()->json($objectType);
        }

        public function getList(Request $request)
        {
                // offset from 0
                $offset = $request->offset;
                $pageSize = $request->pageSize;

                $count = ObjectType::count();
                $skip = $pageSize * $offset;

                $objectTypes = ObjectType::orderBy('name', 'desc')
                        ->skip($skip)
                        ->take($pageSize)
                        ->get();

                if (is_null($objectTypes)) {
                        return response()->json('not found', 404);
                }

                //TODO: filter

                $responseList = new ResponseList();
                $responseList->data = $objectTypes;
                $responseList->offset = $offset;
                $responseList->pageSize = $pageSize;
                $responseList->count = $count;

                return response()->json($responseList);
        }


        public function getListObjectLocationsByObjectTypeId(Request $request, $object_type_id)
        {
                // offset from 0
                $offset = $request->offset;
                $pageSize = $request->pageSize;

                $count = ObjectLocation::count();
                $skip = $pageSize * $offset;

                $objectLocations = ObjectLocation::where('object_type_id', '=', $object_type_id)
                        ->orderBy('rating_number', 'desc')
                        ->skip($skip)
                        ->take($pageSize)
                        ->get();

                if (is_null($objectLocations)) {
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


        public function getListSalesByObjectTypeId(Request $request, $object_type_id)
        {
                // offset from 0
                $offset = $request->offset;
                $pageSize = $request->pageSize;

                $count = Sale::count();
                $skip = $pageSize * $offset;

                $sales = Sale::where('object_type_id', '=', $object_type_id)
                        ->orderBy('price', 'desc')
                        ->skip($skip)
                        ->take($pageSize)
                        ->get();

                if (!$sales) {
                        return response()->json('not found', 404);
                }

                //TODO: filter

                $responseList = new ResponseList();
                $responseList->data = $sales;
                $responseList->offset = $offset;
                $responseList->pageSize = $pageSize;
                $responseList->count = $count;

                return response()->json($responseList);
        }
}
