<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Storage;
class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $req){
        $resultData = $this->doSearchOf($req->query('search_query'));
        return dd($resultData);
        //return view('comicsList',['comics'=>$resultData]);
    }



    public function doSearchOf($term)
    {
        $results = array();
        $results['comics'] = $this->getMatchWith($term,'tb_comic_test','comicaproved = 1 and comickind = 1 and lower(comicname) REGEXP lower("[[:<:]]'.$term.'[[:>:]]")');
        $results['novels'] = $this->getMatchWith($term,'tb_comic_test','comicaproved = 1 and comickind = 2 and lower(comicname) REGEXP lower("[[:<:]]'.$term.'[[:>:]]")');
        $results['authors'] = $this->getMatchWith($term,'tb_user','lower(usname) REGEXP lower("[[:<:]]'.$term.'[[:>:]]")');
        $results['users'] = $this->getMatchWith($term,'tb_user','lower(usnamepro) REGEXP lower("[[:<:]]'.$term.'[[:>:]]")');
        return $results;
    }

    public function getMatchWith($term,$table,$where){
        $resultData = array();
        $getTermComics = 'SELECT * FROM '.$table.' WHERE '.$where;
        $selected = DB::select($getTermComics);
        if($table == "tb_comic_test"){
            foreach ($selected as $c) {
                        $authorsId = array();
                        $authors = array();
                        $getAuthors = 'SELECT auid FROM comic_author WHERE comicid = ?';
                        $authorsId = DB::select($getAuthors,[$c->comicid]);
                        foreach($authorsId as $au){
                            $author = DB::select('select auidus from tb_author where auid = ?',[$au->auid]);
                            $user = DB::select('select usname from tb_user where usid = ?',[$author[0]->auidus]);
                            $data = [$author[0]->auidus,$user[0]->usname];
                            array_push($authors,$data);
                        }
                        $data = [$c,$authors];
                        array_push($resultData,$data);
                    }
        }
        if($table == "tb_user"){
            foreach ($selected as $u) {
                        $getFollowers = 'SELECT COUNT(*) AS followers FROM follow WHERE toUSer = ?';
                        $followers = DB::select($getFollowers,[$u->usid]);
                        $author = DB::select('select * from tb_author where auidus = ?',[$u->usid]);
                        array_push($author,$followers);
                        array_push($author,$u);
                        array_push($resultData, $author);
                    }
        }
        return $resultData;
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
        $comic = new Comic();
        $comic->id = $comic->genId();
        /*$request->validate([
            'usimgpro' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'auimagfr' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        ]);*/

        $cover = 'cover.'.$request->cover->extension();
        $portada = 'port.'.$request->portada->extension();

        // Public Folder
        //$request->usimgpro->move(public_path('images'), $usimgpro);
        //$request->portada->move(public_path('images'), $portada);

        // //Store in Storage Folder
        //Storage::disk('profiles')->put($usimgpro,'Contents');
        //Storage::disk('profiles')->put($portada,'Contents');
        $path = 'comic/'.$comic->id.'/presentation';
        //return $path.'/'.$cover;
        $request->cover->storeAs($path, $cover, 'editorial');
        $request->portada->storeAs($path, $portada, 'editorial');
        //return redirect('/pfp/'.$cover);
        $comic->title = $request->input('comicname');
        $comic->description = $request->input('comicdesc');
        $comic->nextDate = $request->input('comicnext');
        $comic->emitionType = $request->input('comictype');
        $comic->emitionKind = $request->input('comickind');
        $comic_inserted = DB::insert("insert into tb_comic_test values(?,?,?,?,?,?,?,?)",[$comic->id,$comic->title,1,$comic->emitionType,$comic->emitionKind,$comic->description,$comic->nextDate,1]);
        if($comic_inserted ==1){
            $insertAuthor = 'INSERT INTO comic_author VALUES(?,?)';
            $insertedAuthor = DB::insert($insertAuthor,[session('auid'),$comic->id]);
            if($insertedAuthor == 1){

            }
        }

    }
    public function createComic(){
        $getCats = "SELECT * FROM tb_categories";
        $cats = DB::select($getCats);
        return view('createComic',['cats'=>$cats]);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comic  $comic
     * @return \Illuminate\Http\Response
     */
    public function show($comic){
        $getComic = 'SELECT * FROM tb_comic_test WHERE comicid = ?';
        $comic = DB::select($getComic,[$comic]);
        return $comic[0]->comicname;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comic  $comic
     * @return \Illuminate\Http\Response
     */
    public function edit(Comic $comic)
    {
        //
        return "edit ola";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comic  $comic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comic $comic)
    {
        //
        return "update ola";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comic  $comic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comic $comic)
    {
        //
        return "destroy ola";
    }
}
