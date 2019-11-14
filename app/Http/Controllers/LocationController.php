<?php

namespace App\Http\Controllers;

use App\City;
use App\Location;
use App\ResponseList;
use Illuminate\Http\Request;
use App\Http\Resources\City as CityResource;

class LocationController extends Controller
{
        public function create(Request $request)
        {
                $location = new Location();

                $rawBody = $request->json()->all();

                $location->lat = $rawBody['lat'];
                $location->lon = $rawBody['lon'];
                $location->name = $rawBody['name'];
                $location->area = $rawBody['area'];
                $location->city_id = $rawBody['city_id'];
                $location->district = $rawBody['district'];

                $location->save();
                return response()->json($location);
        }

        public function update(Request $request, $id)
        {
                $location = Location::findOrFail($id);

                $rawBody = $request->json()->all();

                $location->lat = $rawBody['lat'];
                $location->lon = $rawBody['lon'];
                $location->name = $rawBody['name'];
                $location->area = $rawBody['area'];
                $location->city_id = $rawBody['city_id'];
                $location->district = $rawBody['district'];

                $location->save();

                return response()->json($location);
        }

        public function getById($id)
        {
                $location = Location::findOrFail($id);

                if (is_null($location)) {
                        return response()->json('not found', 404);
                }

                //$city = City::where('id', '=', $location->city_id)->select('id', 'name', 'code')->first();
                $city = new CityResource(City::find($location->city_id));
                if ($city) {
                        unset($location->city_id);
                        $location->city = $city;
                }

                return response()->json($location);
        }

        public function getList(Request $request)
        {
                // offset from 0
                $offset = $request->offset;
                $pageSize = $request->pageSize;

                $count = Location::count();
                $skip = $pageSize * $offset;

                $locations = Location::orderBy('name', 'desc')
                        ->skip($skip)
                        ->take($pageSize)
                        ->get();

                $cities = City::select('id', 'name', 'code')->get();

                foreach ($locations as $location) {
                        $city = $cities->where('id', '=', $location->city_id)->first();
                        if ($city) {
                                unset($location->city_id);
                                $location->city = $city;
                        }
                }

                if (!$locations) {
                        return response()->json('not found', 404);
                }

                //TODO: filter

                $responseList = new ResponseList();
                $responseList->data = $locations;
                $responseList->offset = $offset;
                $responseList->pageSize = $pageSize;
                $responseList->count = $count;

                return response()->json($responseList);
        }
}
