<?php

namespace App\Http\Controllers;
use Exception;
use Illuminate\Http\Request;
use Response;
use Validator;
use App\Models\User;
use Hash;
class AuthController extends Controller
{
    function register (request $request) {
        $validator = Validator::make($request->all(),  [
            'name'=>'required',
            'email'=>'required',
            "address" => 'required',
            "birthday" => 'required',
            'role'=>'required',
            'password'=> 'required',
        ]);
        if($validator->fails()){
            return response()->json([
                'status'=> false,
                'massage'=> $validator->errors(),
            ]);

        }
        $data = [
            'name'=> $request->get('name'),
            'email' =>$request->get ('email'),
            'password'=>Hash::make($request->get('password')),
            'role'=>$request->get('role'),
            "address"=>$request->get("address"),
            "birthday"=>$request->get("birthday"),
        ];
        try{
            $insert = user::create($data);
            return response()->json(["status"=>true,'massage'=>'data berhasil ditambahkan']);
        }catch(Exception $e){
            return Response()->json(["status"=>false,'massage'=>$e]);
        }
    }
    //
}
