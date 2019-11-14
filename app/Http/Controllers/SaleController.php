<?php

namespace App\Http\Controllers;

use App\Sale;
use App\User;
use App\ObjectType;
use App\Location;
use App\ResponseList;
use Illuminate\Http\Request;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\Location as LocationResource;
use App\Http\Resources\ObjectType as ObjectTypeResource;


class SaleController extends Controller
{
        public function create(Request $request)
        {
                $sale = new Sale();

                $rawBody = $request->json()->all();

                $sale->seller_user_id = $rawBody['seller_user_id'];
                $sale->object_type_id = $rawBody['object_type_id'];
                $sale->object_detail_id = $rawBody['object_detail_id'];
                $sale->status = $rawBody['status'];
                $sale->price = $rawBody['price'];
                $sale->payment_type = $rawBody['payment_type'];
                $sale->location_id = $rawBody['location_id'];
                $sale->location_alias = $rawBody['location_alias'];

                $sale->save();
                return response()->json($sale);
        }

        public function update(Request $request, $id)
        {
                $sale = Sale::findOrFail($id);

                $rawBody = $request->json()->all();

                $sale->name = $rawBody['name'];
                $sale->seller_user_id = $rawBody['seller_user_id'];
                $sale->object_type_id = $rawBody['object_type_id'];
                $sale->object_detail_id = $rawBody['object_detail_id'];
                $sale->status = $rawBody['status'];
                $sale->price = $rawBody['price'];
                $sale->payment_type = $rawBody['payment_type'];
                $sale->location_id = $rawBody['location_id'];
                $sale->location_alias = $rawBody['location_alias'];

                $sale->save();

                return response()->json($sale);
        }

        public function getById($id)
        {
                $sale = Sale::findOrFail($id);

                if (is_null($sale)) {
                        return response()->json('not found', 404);
                }

                $user = new UserResource(User::find($sale->seller_user_id));
                unset($sale->seller_user_id);
                $sale->seller = $user;

                $objectType = new ObjectTypeResource(ObjectType::find($sale->object_type_id));
                unset($sale->object_type_id);
                $sale->object_type = $objectType;

                $location = new LocationResource(Location::find($sale->location_id));
                unset($sale->location_id);
                $sale->location = $location;

                return response()->json($sale);
        }

        public function getList(Request $request)
        {
                // offset from 0
                $offset = $request->offset;
                $pageSize = $request->pageSize;

                $count = Sale::count();
                $skip = $pageSize * $offset;

                $sales = Sale::orderBy('created_at', 'desc')
                        ->skip($skip)
                        ->take($pageSize)
                        ->get();

                if (is_null($sales)) {
                        return response()->json('not found', 404);
                }

                $objectTypes = ObjectType::select('id', 'name', 'description')->get();
                foreach ($sales as $sale) {
                        $user = User::find($sale->seller_user_id)->select(
                                'name',
                                'email',
                                'password',
                                'first_name',
                                'last_name',
                                'phone1',
                                'phone2',
                                'location_id',
                                'rating_number',
                                'is_verified'
                        )->first();

                        unset($sale->seller_user_id);
                        $sale->seller = $user;

                        $objectType = $objectTypes->where('id', '=', $sale->object_type_id)->first();
                        unset($sale->object_type_id);
                        $sale->object_type = $objectType;

                        $location = new LocationResource(Location::find($sale->location_id));
                        unset($sale->location_id);
                        $sale->location = $location;
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
