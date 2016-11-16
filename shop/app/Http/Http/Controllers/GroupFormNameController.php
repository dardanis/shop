<?php namespace App\Http\Controllers;
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
use Str;
use Illuminate\Http\Request;
class GroupFormNameController extends Controller {

    public function index()
    {
        $groupname=\App\GroupFormNaming::all();

        return view('admin.formname.index')->with('groupname',$groupname);
    }
    public function add()
    {
        $category = array();
        $cat = Category::all();
        foreach ($cat as $c) {
            $category[$c->id] = $c->name;
        }
        return view('admin.formname.add')->with('category',$category);
    }
    public function store()
    {
            $formname = new GroupFormNaming();
            $formname->group_name = $_POST['group_name'];
          $formname->category_id=Input::get('category_id');
            if($formname->save()){
            return Redirect::route('formnameindex');
        }

    }

    public function update($id)
    {
        $groupname=GroupFormNaming::find($id);

        $groupname->group_name=Input::get('group_name');
        $groupname->category_id=Input::get('category_id');
        $groupname->update();
        return Redirect::route('formnameindex');
    }
    public function edit($id)
    {
        $category = array();
        $cat = Category::all();
        foreach ($cat as $c) {
            $category[$c->id] = $c->name;
        }
        $formname=GroupFormNaming::where('id','=',$id)->get()->first();
        $name= $formname->group_name;

        return view('admin.formname.edit')->with('name',$name)->with('id',$id)->with('formname',$formname)->with('category',$category);

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

