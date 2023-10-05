<?php

namespace App\Http\Controllers\Api;

use App\Models\UserMeta;
use App\Models\UserCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Validator;
use Illuminate\Http\JsonResponse;

class RegisterController extends BaseController
{

    /**
     * create new user
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request): JsonResponse
    {
        //$data = $request->all();
        //return $this->sendResponse(json_decode($data['service_id']), 'User register successfully.');
        try {

            $data = $request->all();

            $validator = Validator::make($data, [
                'name' => 'required',
                'email' => 'required|email',
                'phone' => ['required', 'string', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:6'],
            ]);

            if($validator->fails()){
                return $this->sendError('Validation Error.', $validator->errors());
            }

            $user = User::create([
                'unique_id' => Str::random(11),
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'date_of_birth' => null,
                'gender' => 1,
                'photo' => null,
                'balance' => 0,
                'price' => $data['price'] ?? 0,
                'status' => 0,
                'role' => $data['role'],
                'password' => Hash::make($data['password']),
            ]);

            //$user->assignRole($data['role']);
            //$user->assignRole($role);

            $metas = [
                'qualification',
                'education',
                'training',
                'place_of_work', //clinic
                'address'
            ];

            if(isset($data['category_id'])) {
                foreach(json_decode($data['category_id']) as $category) {
                    if(isset($category->isChecked)) {
                        UserCategory::create([
                            'category_id' => $category->id,
                            'user_id' => $user->id,
                        ]);
                    }
                }
            }

            foreach ($metas as $meta) {
                UserMeta::create([
                    'user_id' => $user->id,
                    'key' => $meta,
                    'value' => $data[$meta] ?? ''
                ]);
            }

            $success['token'] = $user->createToken('MyApp')->plainTextToken;
            $success['user_id'] =  $user->id;
            $success['role'] =  $user->role;


            return $this->sendResponse($success, 'User register successfully.');

        } catch (\Exception $e) {

            return $this->sendError('Validation Error.', $e->getMessage());
        }
    }


    public function update(Request $request): JsonResponse
    {
        try {

            $data = $request->all();

            $validator = Validator::make($data, [
                'name' => 'required',
                //'email' => 'required|email',
                //'phone' => ['required', 'string', 'max:255', 'unique:users'],
                //'password' => ['required', 'string', 'min:6'],
            ]);

            if($validator->fails()){
                return $this->sendError('Validation Error.', $validator->errors());
            }

            $user = User::find($data['id']);

            $user->name = $data['name'];
            //$user->email = $data['email'];
            //$user->phone = $data['phone'];
            $user->date_of_birth = null;
            $user->gender = 1;
            $user->photo = null;
            $user->balance = 0;
            $user->price = $data['price'] ?? 0;

            $user->save();

            //$user->assignRole($data['role']);
            //$user->assignRole($role);

            $metas = [
                'qualification',
                'education',
                'training',
                'place_of_work', //clinic
                'address'
            ];

            UserCategory::where("user_id", $user->id)->delete();

            if(isset($data['category_id'])) {
                foreach(json_decode($data['category_id']) as $category) {
                    if(isset($category->isChecked)) {
                        UserCategory::create([
                            'category_id' => $category->id,
                            'user_id' => $user->id,
                        ]);
                    }
                }
            }

            foreach ($metas as $meta) {
                UserMeta::create([
                    'user_id' => $user->id,
                    'key' => $meta,
                    'value' => $data[$meta] ?? ''
                ]);
            }


            return $this->sendResponse(['message' => 'success'], 'User updated successfully.');

        } catch (\Exception $e) {

            return $this->sendError('Validation Error.', $e->getMessage());
        }
    }
}
