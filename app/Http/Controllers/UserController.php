<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::all();
        return view('user',compact('users'));
    }

    public function user_update(Request $request)
    {
        // validate value
        if($request->id!=""&&$request->id!=null&&$request->id!="0")
        {
            // validate value
            $request->validate(
                ['name' =>'required','email' =>'required','username' =>'required','surname' =>'required']
                ,['name.required' => 'Please Insert Name','email.required' => 'Please Insert Email'
                ,'username.required' => 'Please Insert Username','surname.required' => 'Please Insert Surname']
            );

            $decode_id = str_replace("dgtei","",base64_decode($request->id));

            $updatedata = [
                'name'=>$request->name,
                'surname'=>$request->surname,
                'email'=>$request->email,
                'username'=>$request->username,
                'update_date'=>date("Y-m-d H:i:s"),
            ];
            if($request->password!="")
            {
                $updatedata['password'] = $request->password;
            }

            $update = DB::table('users')->where('id', $decode_id)->update($updatedata);


            return redirect()->route('users')->with('success','Form Edited');
        }
        else
        {
            // validate value
            $request->validate(
                ['name' =>'required','email' =>'required','username' =>'required','surname' =>'required']
                ,['name.required' => 'Please Insert Name','email.required' => 'Please Insert Email'
                ,'username.required' => 'Please Insert Username','surname.required' => 'Please Insert Surname']
            );

            // store to customer DB

            $data = array(
                'name' => $request->name,
                'surname' => $request->surname,
                'email' => $request->email,
                'username' => $request->username,
                'password' => $request->password,
                'created_date' => date("Y-m-d H:i:s"),
                'update_date' => date("Y-m-d H:i:s")
            );
            DB::table('users')->insert($data);

            $user->save();
        }
        return redirect()->back()->with('success','Form Added');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = array(
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'username' => $request->username,
            'password' => $request->password,
            'created_date' => date("Y-m-d H:i:s"),
            'update_date' => date("Y-m-d H:i:s")
        );
       DB::table('users')->insert($data);

        if($save)
        {
            $data['status'] = 201;
            $data['message'] = "Insert Complete";
            $data['user'] = $user;
        }
        else
        {
            $data['status'] = 500;
            $data['message'] = "Insert Incomplete";
            $data['user'] = "";
        }
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
        $users = User::all();
        $data['status'] = 200;
        $data['message'] = "Get Users Complete";
        $data['user'] = $user;
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $decode_id = str_replace("dgtei","",base64_decode($id));
        $user = User::find($decode_id);
        $user->enc_id = base64_encode($user->id."dgtei");
        $data['status'] = 200;
        $data['message'] = "Get User Complete";
        $data['user'] = $user;
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        if($request->id!=""&&$request->id!=null&&$request->id!="0")
        {
            $decode_id = str_replace("dgtei","",base64_decode($id));
            $updatedata = [
                'name'=>$request->name,
                'surname'=>$request->surname,
                'email'=>$request->email,
                'username'=>$request->username,
                'update_date'=>date("Y-m-d H:i:s"),
            ];
            if($request->password!="")
            {
                $updatedata['password'] = $request->password;
            }

            $update = DB::table('users')->where('id', $decode_id)->update($updatedata);

            $data['status'] = 200;
            $data['message'] = "User Updated";
            $data['user'] = $updatedata;

            return response()->json($data);
        }
        else
        {
            $data['status'] = 500;
            $data['message'] = "No User Data";
            $data['user'] = "";
            return response()->json($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete =  DB::table('users')->where('id', $decode_id)->delete();

        $data['status'] = 200;
        $data['message'] = "User Delete";
        $data['user'] = $updatedata;

        return response()->json($data);
    }
}
