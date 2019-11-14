<?php

namespace App\Http\Controllers;

use App\Favorite;
use App\ResponseList;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
        public function create(Request $request)
        {
                $favorite = new Favorite();

                $rawBody = $request->json()->all();
                $favorite->user_id = $rawBody['user_id'];
                $favorite->object_type_id = $rawBody['object_type_id'];
                $favorite->object_detail_id = $rawBody['object_detail_id'];

                $favorite->save();
                return response()->json($favorite);
        }

        public function update(Request $request, $id)
        {
                $favorite = Favorite::findOrFail($id);

                $rawBody = $request->json()->all();

                $favorite->user_id = $rawBody['user_id'];
                $favorite->object_type_id = $rawBody['object_type_id'];
                $favorite->object_detail_id = $rawBody['object_detail_id'];

                $favorite->save();

                return response()->json($favorite);
        }

        public function getById($id)
        {
                $favorite = Favorite::findOrFail($id);

                if (is_null($favorite)) {
                        return response()->json('not found', 404);
                }

                return response()->json($favorite);
        }

        public function getList(Request $request)
        {
                // offset from 0
                $offset = $request->offset;
                $pageSize = $request->pageSize;

                $count = Favorite::count();
                $skip = $pageSize * $offset;

                $favorites = Favorite::orderBy('id', 'desc')
                        ->skip($skip)
                        ->take($pageSize)
                        ->get();

                if (is_null($favorites)) {
                        return response()->json('not found', 404);
                }

                //TODO: filter

                $responseList = new ResponseList();
                $responseList->data = $favorites;
                $responseList->offset = $offset;
                $responseList->pageSize = $pageSize;
                $responseList->count = $count;

                return response()->json($responseList);
        }
}
