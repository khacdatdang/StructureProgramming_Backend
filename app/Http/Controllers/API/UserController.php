<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    public function viewprofile($email){
        $user = User::where('email', $email)->first();
        if ($user){
            return response()->json([
                'status' => 200,
                'user'=> $user
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message'=> 'Cannot find user'
            ]);
        }
    }

    public function updateprofile(Request $request, $email){
        $validator = Validator::make($request->all(),
        [
            'name' => 'required|max:191',
            'tel' => 'required|min:11|numeric',
            'address' => 'required|max:300',
        ]);

        if ($validator ->fails()){
            return response() ->json([
                'status' => 422,
                'validation_errors' => $validator->getMessageBag(),
            ]);
        }
        else {
            $user = User::where('email', $email)->first();
            if ($user) {
                $user->name = $request->name;
                $user->tel =  $request->tel;
                $user->address = $request->address;
                $user->save();
                return response()->json([
                    'status' => 200,
                    'message' => 'Update Success'
                ]);
            }
            else return response() ->json([
                'status' => 404,
                'message' => 'Cannot find users'
            ]);
        }


        
    }
}
