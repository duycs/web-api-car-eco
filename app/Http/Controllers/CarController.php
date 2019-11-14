<?php

namespace App\Http\Controllers;

use App\Car;
use App\Brand;
use App\CarModel;
use App\Color;
use App\ResponseList;
use Illuminate\Http\Request;
use App\Http\Resources\CarModel as CarModelResource;
use App\Http\Resources\Brand as BrandResource;
use App\Http\Resources\Color as ColorResource;

class CarController extends Controller
{
        public function create(Request $request)
        {
                $car = new Car();

                $rawBody = $request->json()->all();

                $car->name = $rawBody['name'];
                $car->brand_id = $rawBody['brand_id'];
                $car->model_id = $rawBody['model_id'];
                $car->year_manufacture = $rawBody['year_manufacture'];
                $car->product_status = $rawBody['product_status'];
                $car->kilometers_number = $rawBody['kilometers_number'];
                $car->gearbox_number = $rawBody['gearbox_number'];
                $car->fuel = $rawBody['fuel'];
                $car->color_id = $rawBody['color_id'];
                $car->rating_number = $rawBody['rating_number'];
                $car->door_number = $rawBody['door_number'];
                $car->engine_name = $rawBody['engine_name'];
                $car->power_number = $rawBody['power_number'];
                $car->furniture_type = $rawBody['furniture_type'];
                $car->exterior_type = $rawBody['exterior_type'];
                $car->equipment_type = $rawBody['equipment_type'];
                $car->description = $rawBody['description'];

                $comma_separated_photos = implode(",", $rawBody['photos']);
                $car->photos = $comma_separated_photos;

                $car->save();
                return response()->json($car);
        }

        public function update(Request $request, $id)
        {
                $car = Car::findOrFail($id);

                $rawBody = $request->json()->all();

                $car->name = $rawBody['name'];
                $car->brand_id = $rawBody['brand_id'];
                $car->model_id = $rawBody['model_id'];
                $car->year_manufacture = $rawBody['year_manufacture'];
                $car->product_status = $rawBody['product_status'];
                $car->kilometers_number = $rawBody['kilometers_number'];
                $car->gearbox_number = $rawBody['gearbox_number'];
                $car->fuel = $rawBody['fuel'];
                $car->color_id = $rawBody['color_id'];
                $car->rating_number = $rawBody['rating_number'];
                $car->door_number = $rawBody['door_number'];
                $car->engine_name = $rawBody['engine_name'];
                $car->power_number = $rawBody['power_number'];
                $car->furniture_type = $rawBody['furniture_type'];
                $car->exterior_type = $rawBody['exterior_type'];
                $car->equipment_type = $rawBody['equipment_type'];
                $car->description = $rawBody['description'];

                $comma_separated_photos = implode(",", $rawBody['photos']);
                $car->photos = $comma_separated_photos;

                $car->save();

                return response()->json($car);
        }

        public function getById($id)
        {
                $car = Car::findOrFail($id);

                if (!$car) {
                        return response()->json('not found', 404);
                }

                
                $brand = new BrandResource(Brand::find($car->brand_id));
                unset($car->brand_id);
                $car->brand = $brand;

                $model = new CarModelResource(CarModel::find($car->model_id));
                unset($car->model_id);
                $car->model = $model;

                $color = new ColorResource(Color::find($car->color_id));
                unset($car->color_id);
                $car->color = $color;


                $car->photos = explode(',', $car->photos);

                return response()->json($car);
        }

        public function getList(Request $request)
        {
                // offset from 0
                $offset = $request->offset;
                $pageSize = $request->pageSize;

                $count = Car::count();
                $skip = $pageSize * $offset;

                $cars = Car::orderBy('rating_number', 'desc')
                        ->skip($skip)
                        ->take($pageSize)
                        ->get();

                if (is_null($cars)) {
                        return response()->json('not found', 404);
                }

                $brands = new BrandResource(Brand::all());
                $models = new CarModelResource(CarModel::all());
                $colors = new ColorResource(Color::all());
                foreach ($cars as $car) {
                        $brand = $brands->where('id', '=', $car->brand_id)->first();
                        unset($car->brand_id);
                        $car->brand = $brand;

                        $model = $models->where('id', '=', $car->model_id)->first();
                        unset($car->model_id);
                        $car->model = $model;

                        $color = $colors->where('id', '=', $car->color_id)->first();
                        unset($car->color_id);
                        $car->color = $color;
                }


                //TODO: filter

                $responseList = new ResponseList();
                $responseList->data = $cars;
                $responseList->offset = $offset;
                $responseList->pageSize = $pageSize;
                $responseList->count = $count;

                return response()->json($responseList);
        }
}
