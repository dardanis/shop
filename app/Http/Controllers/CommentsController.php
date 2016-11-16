<?php namespace App\Http\Controllers;
use App\Offers;
use App\Comments;
use Input;
use Session;
use Redirect;
use Validator;
use Auth;
use File;
use App;
use DB;
use Lang;
use Image;
class CommentsController extends Controller {


    public function index()
    {
        return view('comments.index');
    }


    public function add()
    {
        return view('comments.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {

        $user_id=\App\User::find(Auth::user()->id);
       if(!empty($_POST['comment'])){
           $comments=new Comments();
           $comments->user_id=$user_id['id'];
           $comments->comment=$_POST['comment'];
           $comments->offer_id=$_POST['offer_id'];
            if($comments->save()){
                if(isset($_GET['user_id'])){
                    $user_id=$_GET['user_id'];
                    return Redirect::to("viewprofile?user_id=$user_id")->with('success', 'Comment added successfully');
                }else{
                    return Redirect::route('viewprofile')->with('success','Comment added successfully');
                }

            }

       }


    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($alias,$id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */

    public function delete_area($area_id)
    {

    }
    public function destroy($id)
    {
        //
    }

}
