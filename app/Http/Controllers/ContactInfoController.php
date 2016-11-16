<?php namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Validator;
use Input;
use Redirect;
use App\User;
use App\Role;
use Hash;
use Auth;
use Carbon;
use App\Product;
use App\Category;
use App\Subcategory;
use File;
use App\Picture;
use App\Online;
use App\Slider;
use App\Review;
use App\Activity;
use App\GroupFormNaming;
use App\ContactInfo;
use Str;
use Illuminate\Http\Request;
class ContactInfoController extends Controller {

    public function index()
    {

    }
    public function add()
    {
        return view('contactinfo.add');
    }
    public function store()
    {
        $user_id=\App\User::find(Auth::user()->id);


        DB::delete('DELETE FROM contact_infos WHERE user_id ="'.$user_id['id'].'" ');
        $input = Input::all();
        $v = Validator::make($input, ContactInfo::$rules);
        if ($v->passes()) {
            $contactinfo = new ContactInfo();
            $contactinfo->name = $_POST['name'];
            $contactinfo->gender = $_POST['gender'];
            $contactinfo->last_name = $_POST['last_name'];
            $contactinfo->activity_site = $_POST['activity_site'];
            $contactinfo->profession = $_POST['profession'];
            $contactinfo->username = $_POST['username'];
            $contactinfo->activity_society = $_POST['activity_society'];
            $contactinfo->phone = $_POST['phone'];
            $contactinfo->email = $_POST['email'];
            $contactinfo->street = $_POST['street'];
            $contactinfo->optional_street = $_POST['optional_street'];
            $contactinfo->zip = $_POST['zip'];
            $contactinfo->location = $_POST['location'];
            $contactinfo->payment = $_POST['payment'];
            $contactinfo->user_id = $user_id['id'];
            if ($contactinfo->save()) {
                return Redirect::route('contact')->with('success','Contact information added successfully');

            }
        }
        return Redirect::back()->withErrors($v)->withInput(Input::flash());

    }

    public function update($id)
    {
        $groupname=GroupFormNaming::find($id);

        $groupname->group_name=Input::get('group_name');

        $groupname->update();
        return Redirect::route('formnameindex');
    }
    public function edit($id)
    {
        $formname=GroupFormNaming::where('id','=',$id)->get()->first();
        $name= $formname->group_name;

        return view('contactinfo.edit');

    }
    public function destroy($id){
        $groupname=GroupFormNaming::find($id);
        if($groupname)
        {
            $groupname->delete();
            return Redirect::route('formnameindex')->with('success','Form name deleted successfully');
        }
        return Redirect::route('formnameindex')->with('error','Form  not found');
    }
}

