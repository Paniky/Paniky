<?php

namespace App\Http\Controllers;
use DB;
use App\Models\Author;
use Illuminate\Http\Request;
use Storage;
class AuthorController extends Controller
{
    public function register()
    {   
        $titles = DB::select('select * from tb_titles');

        return view('registerForm',['titles'=>$titles]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $authors = array();
        $users = DB::select('select usid,usname,usnamepro,usmail,usimgpro from tb_user where ustype = 1');
        foreach ($users as $u) {
            $getFollowers = 'SELECT COUNT(*) AS followers FROM follow WHERE toUSer = ?';
            $followers = DB::select($getFollowers,[$u->usid]);
            $author = DB::select('select * from tb_author where auidus = ?',[$u->usid]);
            array_push($author,$followers);
            array_push($author,$u);
            array_push($authors, $author);
        }
        //return $authors;
        return view('authorsList',['authors'=>$authors]);
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
        $wasInserted = false;
        $author = new Author();
        $author->usid = $author->genId();
        /*$request->validate([
            'usimgpro' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'auimagfr' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        ]);*/

        $usimgpro = $author->usid.'prof.'.$request->usimgpro->extension();
        $auimgfr = $author->usid.'land.'.$request->auimgfr->extension();

        // Public Folder
        //$request->usimgpro->move(public_path('images'), $usimgpro);
        //$request->auimgfr->move(public_path('images'), $auimgfr);

        // //Store in Storage Folder
        //Storage::disk('profiles')->put($usimgpro,'Contents');
        //Storage::disk('profiles')->put($auimgfr,'Contents');
        $request->usimgpro->storeAs('pfp', $usimgpro, 'profiles');
        $request->auimgfr->storeAs('land', $auimgfr, 'profiles');
        //return redirect('/pfp/'.$usimgpro);
        $author->usname = $request->input('name');
        $author->usmail = $request->input('mail');
        $author->usnamepro = $request->input('alias');
        $author->usimgpro = $usimgpro;
        $author->algo = "2y";
        $author->cost = 10;
        $pswd = $request->input('psswd');
        $author->hash = bcrypt($pswd);
        
        if(!$author->isDuplicated()){
            $user_inserted = DB::insert("insert into tb_user values(?,?,?,?,?,?,?,?,?)",[$author->usid,$author->usname,$author->usnamepro,$author->usmail,1,$author->usimgpro,$author->algo,$author->cost,$author->hash]);    
            $wasInserted = true;
        }
        
        if($wasInserted){  
            $author->auloc = $request->input('auloc');
            $author->auwebs = $request->input('auwebs');
            $author->aupermal = $request->input('aupermal');
            $author->audonl = $request->input('audonl');
            $author->auimgfr = $auimgfr;
            $author->audesc = $request->input('audesc');
            $author->autitle = $request->input('autitle');
            $author->insertion();
            return 'Registrado';
        }
        return 'Duplicado';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = array();
        $getFollowers = 'SELECT COUNT(*) AS followers FROM follow WHERE toUSer = ?';
        $getUser = 'SELECT * FROM tb_user WHERE usid = ?';
        $getAuthor = 'SELECT * FROM tb_author WHERE auidus = ?';
        $author = array();
        $user = array();
        $followers = array();
        $user = DB::select($getUser,[$id]);
        $author = DB::select($getAuthor,[$id]);
        $followers = DB::select($getFollowers,[$id]);
        array_push($data,$user);
        array_push($data,$author);
        array_push($data,$followers);
        //return $data;
        return view('profile',['profile'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function edit(Author $author)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Author $author)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        //
    }
}
