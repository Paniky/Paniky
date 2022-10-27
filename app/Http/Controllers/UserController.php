<?php

namespace App\Http\Controllers;
use DB;
use App\Models\User;
use App\Models\Author;
use Illuminate\Http\Request;

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
        $users = array();
        $users = DB::select('select usid,usmail,usname,usnamepro from tb_user');
        return view('usersList',['users'=>$users]);
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
        //

        $user = new User();
        $user->usname = $request->input('name');
        $user->usmail = $request->input('mail');
        $user->usnamepro = $request->input('alias');
        $user->usimgpro = $request->input('imag');
        $user->algo = "2y";
        $user->cost = 10;
        $pswd = $request->input('psswd');
        $user->hash = bcrypt($pswd);
        
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function show($User)
    {
        //
        $UserM = new User();
        $UserM->name = $User;
        return $UserM->name;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function edit(User $User)
    {
        //
        return "edit ola";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $User)
    {
        //
        return "update ola";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $User)
    {
        //
        return "destroy ola";
    }
    public function logForm()
    {
        return view('login');
    }
    public function login(Request $request){
        $user = new User();
        $user->usmail = $request->input('mail');
        $user->usnamepro = $request->input('mail');
        $userData = $user->login($request->input('psswd'));
        
        //MISMATCHED CREDENTIALS CASE
        if($userData[0] == 0){
            return "No inicio sesion";
        }
        
        //AUTHOR CASE 
        if($userData[0] == 1){
            $authorData = Author::getDataById($userData[1]->usid);
            session(['usid'=>$userData[1]->usid,'usname'=>$userData[1]->usname,'usnamepro'=>$userData[1]->usnamepro,'ustype'=>$userData[1]->ustype,'usmail'=>$userData[1]->usmail,'usimgpro'=>$userData[1]->usimgpro,'auid'=>$authorData->auid]);
            
            return redirect('/'.$userData[1]->usid);
        }
    }
    public function follow($users)
    {
        $indicate = "Algo salio mal";
        $data = unserialize($users);
        $to = $data[0];
        $from = $data[1];
        $insert = User::follow($to,$from);
        if($insert == 1){
            $indicate = "Ahora sigues al usuario ".$to;
        }
        return $indicate;
    }
}
