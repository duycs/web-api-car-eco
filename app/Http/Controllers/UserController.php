<?php

namespace App\Http\Controllers;

use App\User;
use App\ResponseList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;


class UserController extends Controller
{
        public function authenticate(Request $request)
        {
                $credentials = $request->only('email', 'password');

                try {
                        if (!$token = JWTAuth::attempt($credentials)) {
                                return response()->json(['error' => 'invalid_credentials'], 400);
                        }
                } catch (JWTException $e) {
                        return response()->json(['error' => 'could_not_create_token'], 500);
                }

                return response()->json(compact('token'));
        }

        public function register(Request $request)
        {
                $validator = Validator::make($request->all(), [
                        'name' => 'required|string|max:255',
                        'email' => 'required|string|email|max:255|unique:users',
                        'password' => 'required|string|min:6|confirmed',
                ]);

                if ($validator->fails()) {
                        return response()->json($validator->errors()->toJson(), 400);
                }

                $user = User::create([
                        'name' => $request->get('name'),
                        'email' => $request->get('email'),
                        'password' => Hash::make($request->get('password')),
                ]);

                $token = JWTAuth::fromUser($user);

                return response()->json(compact('user', 'token'), 201);
        }

        
        public function getById($id)
        {
                $user = User::findOrFail($id);

                if (is_null($user)) {
                        return response()->json('not found', 404);
                }

                return response()->json($user);
        }

        public function updateInfo(Request $request, $id)
        {

                $user = User::findOrFail($id);
                $rawBody = $request->json()->all();

                $user->name = $rawBody['name'];
                $user->first_name = $rawBody['first_name'];
                $user->last_name = $rawBody['last_name'];
                $user->phone1 = $rawBody['phone1'];
                $user->phone2 = $rawBody['phone2'];
                $user->location_id = $rawBody['location_id'];
                $user->rating_number = $rawBody['rating_number'];
                $user->is_verified = $rawBody['is_verified'];

                $user->save();
                return response()->json($user);
        }

        public function getAuthenticatedUser()
        {
                try {

                        if (!$user = JWTAuth::parseToken()->authenticate()) {
                                return response()->json(['user_not_found'], 404);
                        }
                } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

                        return response()->json(['token_expired'], $e->getStatusCode());
                } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

                        return response()->json(['token_invalid'], $e->getStatusCode());
                } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

                        return response()->json(['token_absent'], $e->getStatusCode());
                }

                return response()->json(compact('user'));
        }
}
