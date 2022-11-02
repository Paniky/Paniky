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
        $results['users'] = $this->getMatchWith($term,'tb_user','lower(usnamepro) LIKE lower("%'.$term.'%")');
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

}
