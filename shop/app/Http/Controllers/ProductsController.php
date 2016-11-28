<?php namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\EventFields;
use App\User;
use Input;
use Session;
use Redirect;
use Validator;
use Image;
use Illuminate\Support\Str;
use Auth;
use App\Subcategory;
use File;
use App\Picture;
use App\Review;
use App;
use DB;
use Lang;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function add(){

        $category_get=$_GET['cat_id'];
        $type_category = Category::where('id', '=', $category_get)->get();
       foreach($type_category as $tc){
           $type_name = App\product_type::where('id', '=', $tc->type_id)->get();

       }
        foreach($type_name as $tn){
            $type_name= $tn->name;
        }

        $url = config('medias.url');
        $category = array();
        $sub_category = array();
        $subcat = Subcategory::where('category_id', '=', $category_get)->where('parent_sub_category_id','=',NULL)->get();
        foreach($subcat as $sc){
            $sub_category[$sc->id] = $sc->name;
        }
        $cat = Category::all();
        foreach ($cat as $c) {
            $category[$c->id] = $c->name;
        }

        $type = array();
        $types = App\product_type::all();
        foreach ($types as $t) {
            $type[$t->id] = $t->name;
        }

        $categories=Category::with('translations')->whereHas('products', function($q){
            $q->where('status','!=',0);
        })->get();
        return view('products.add')->with('category', $category)->with('type',$type)->with(compact('url'))->with('categories',$categories)->with('type_name1',$type_name)->with('sub_category',$sub_category);
    }

    public function event(){

        $category_get=$_GET['cat_id'];
        $type_category = Category::where('id', '=', $category_get)->get();
       foreach($type_category as $tc){
           $type_name = App\product_type::where('id', '=', $tc->type_id)->get();

       }
        foreach($type_name as $tn){
            $type_name= $tn->name;
        }

        $url = config('medias.url');
        $category = array();
        $sub_category = array();
        $subcat = Subcategory::where('category_id', '=', $category_get)->where('parent_sub_category_id','=',NULL)->get();
        foreach($subcat as $sc){
            $sub_category[$sc->id] = $sc->name;
        }
        $cat = Category::all();
        foreach ($cat as $c) {
            $category[$c->id] = $c->name;
        }

        $type = array();
        $types = App\product_type::all();
        foreach ($types as $t) {
            $type[$t->id] = $t->name;
        }

        $categories=Category::with('translations')->whereHas('products', function($q){
            $q->where('status','!=',0);
        })->get();
        return view('products.event')->with('category', $category)->with('type',$type)->with(compact('url'))->with('categories',$categories)->with('type_name1',$type_name)->with('sub_category',$sub_category);
    }
    public function shopfields( $slug,$id)
    {

        $product = Product::with('pictures')->whereHas('translations', function ($q) use ($slug) {
            $q->where('slug', 'like', '%' . $slug . '%');
        })->get()->first();

        $user_id = $product->user_id;
        $user = User::find(Auth::user()->id);
        $user_role = $user['role']['name'];
        if ($user_id === Auth::user()->id || $user_role=='admin') {
            $category = array();
            $subcategory = array();
            $cat = Category::all();
            foreach ($cat as $c) {
                $category[$c->id] = $c->name;
            }
            $sub = Subcategory::all();
            foreach ($sub as $s) {
                $subcategory[$s->id] = $s->name;
            }
            $type = array();
            $types = App\product_type::all();
            foreach ($types as $t) {
                $type[$t->id] = $t->name;
            }
            $categories=Category::with('translations','subcategories')->whereHas('products', function($q){
                $q->where('status','!=',0);
            })->get();
            return view('products.shopfields')->with('product', $product)->with('category', $category)->with('subcategories', $subcategory)->with('type',$type)->with('categories',$categories)->with('slug',$slug);
        } else {
            return Redirect::back();
        }

    }
    public function storeshopfields($slug,$id)
    {
        $product = Product::find($id);

        $pictureproduct = Product::with('pictures')->find($id)->pictures;


        $input = Input::all();
        $v = Validator::make($input, Product::$rules);
        $user = User::find(Auth::user()->id);
        $user_role = $user['role']['name'];

        $image = Input::file('image');

        if ($image == "") {
            $product->thumbnail = $product['thumbnail'];
        }

        if ($product) {
          //  $product->title = Input::get('title');
          //  $product->slug = Str::slug(Input::get('title'));
           // $product->category_id = Input::get('category_id');
         //   $product->type_id = Input::get('type_id');
          //  $product->subcategory_id = Input::get('subcategory_id');
          //  $product->description = Input::get('description');
         //   $product->search_keywords = Input::get('search_keywords');
            $product->price = Input::get('price');
            $product->availability = Input::get('availability');
         //   $product->user_id = Auth::user()->id;
         //   $product->lat = Input::get('lat');
          //  $product->lng = Input::get('lng');
            //$product->address = Input::get('address');


            $product->save();
            $this->add_activity(Auth::user()->id, 'edited product', 'edit');
            return Redirect::route('shopfields_create', array($slug, $id))->withSuccess('The Item is saved successfully', 'The Item is saved successfully');
        }
    }

    public function store()
    {

        $locale = Lang::locale();
        $languages = $this->languages();
        foreach ($languages as $key => $l) {
            if ($l['lang'] === $locale) {
                unset($languages[$key]);
            }
        }

         $category_id = Input::get('category_id');
        $type_id="";
        $category = Category::find($category_id)->get();

        foreach($category as $c){
            $type_id=$c->type_id;
        }
        $subcategory_id = Input::get('subcategory_id');
        $sub_sub_category_id= Input::get('sub_sub_category_id');
        $input = Input::all();
        $v = Validator::make($input, Product::$rules);
        if(Input::get('price')==""){
            $input_price=0.00;
        }else {
            $input_price=Input::get('price');
        }
        if ($v->passes()) {
            $user = User::find(Auth::user()->id);
            $product = new Product;
            $product->title = Input::get('title');
            $product->teaser = Input::get('teaser');
            $product->price = $input_price;
            $randomnumber = mt_rand(1, 1000);
            $slug = Str::slug(Input::get('title')) . '-' . $randomnumber;
            $product->slug = $slug;
            $product->category_id = $category_id;
            $product->subcategory_id = $subcategory_id;
            $product->sub_sub_category_id=$sub_sub_category_id;

            $product->type_id = $type_id;
            $product->description = Input::get('description');
            $product->search_keywords = Input::get('search_keywords');
            //$product->price = Input::get('price');
            $product->user_id = $user->id;
            $image = Input::file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('img/products/' . $filename);
            Image::make($image->getRealPath())->save($path);
            $product->thumbnail = 'img/products/' . $filename;
            if ($user->subscribed()) {
                $product->sponsored = 1;
            }
            $thumbnail = Input::file('thumbnail');
            //$thumbnail_back = time() . '.thumbnail_back.' . $thumbnail->getClientOriginalExtension();
            //$path_thumbnail = public_path('img/products/' . $thumbnail_back);
           //Image::make($thumbnail->getRealPath())->save($path_thumbnail);
            //$product->thumbnail_back = 'img/products/' . $thumbnail_back;

            $product->lat = Input::get('lat');
            $product->lng = Input::get('lng');
            $product->address = Input::get('address');
            $product->save();

            foreach ($languages as $l) {
                $langid = $l['id'] + 1;
                DB::table('product_translations')->insert(array(
                    array(
                        'title' => Input::get('title'),
                        'teaser' => Input::get('teaser'),
                        'slug' => $slug,
                        'description' => Input::get('description'),
                        'product_id' => $product->id,
                        'locale_id' => $langid,
                        'created_at' => \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now()
                    )
                ));
            }

            if (Input::hasFile('pics')) {
                $pics = Input::file('pics');
                foreach ($pics as $pic) {

                    $filename2 = $pic->getClientOriginalName();
                    $path2 = public_path('img/products/' . $filename2);
                    Image::make($pic->getRealPath())->save($path2);
                    $picture = new Picture;
                    $picture->image = 'img/products/' . $filename2;
                    $picture->product_id=$product->id;
                    $picture->save();

                }
            }
            $this->add_activity(Auth::user()->id, 'added new product', 'add');

            return Redirect::route('product_attributes',array($product->slug,$product->id))->with('category_id',$category_id)->withSuccess('The Item is saved successfully','The Item is saved successfully');

        }

        return Redirect::back()->withErrors($v)->withInput(Input::flash());
    }
public function storeevent()
    {

        $locale = Lang::locale();
        $languages = $this->languages();
        foreach ($languages as $key => $l) {
            if ($l['lang'] === $locale) {
                unset($languages[$key]);
            }
        }

         $category_id = Input::get('category_id');
        $type_id="";
        $category = Category::find($category_id)->get();

        foreach($category as $c){
            $type_id=$c->type_id;
        }
        $subcategory_id = Input::get('subcategory_id');
        $sub_sub_category_id= Input::get('sub_sub_category_id');
        $input = Input::all();
        $v = Validator::make($input, Product::$rules);
        if(Input::get('price')==""){
            $input_price=0.00;
        }else {
            $input_price=Input::get('price');
        }

        if ($v->passes()) {
            $user = User::find(Auth::user()->id);
            $product = new Product;
            $product->title = Input::get('title');
            $product->teaser = Input::get('teaser');
            $product->price = $input_price;
            $randomnumber = mt_rand(1, 1000);
            $slug = Str::slug(Input::get('title')) . '-' . $randomnumber;
            $product->slug = $slug;
            $product->category_id = $category_id;
            $product->subcategory_id = $subcategory_id;
            $product->sub_sub_category_id=$sub_sub_category_id;

            $product->type_id = $type_id;
            $product->description = Input::get('description');
            $product->search_keywords = Input::get('search_keywords');
            //$product->price = Input::get('price');
            $product->user_id = $user->id;
            $image = Input::file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('img/products/' . $filename);
            Image::make($image->getRealPath())->save($path);
            $product->thumbnail = 'img/products/' . $filename;
            if ($user->subscribed()) {
                $product->sponsored = 1;
            }
            $thumbnail = Input::file('thumbnail');
            //$thumbnail_back = time() . '.thumbnail_back.' . $thumbnail->getClientOriginalExtension();
            //$path_thumbnail = public_path('img/products/' . $thumbnail_back);
           //Image::make($thumbnail->getRealPath())->save($path_thumbnail);
            //$product->thumbnail_back = 'img/products/' . $thumbnail_back;

            $product->lat = Input::get('lat');
            $product->lng = Input::get('lng');
            $product->address = Input::get('address');
            $product->save();

            $eventfield=new EventFields;
             if(isset($_POST['event_date'])){
                  $date =$_POST['event_date'];
                $eventfield->date_event=date('Y-m-d', strtotime(str_replace('-','/', $date)));
    
                $eventfield->time_from=$_POST['time_from'];
                $eventfield->time_to=$_POST['time_to'];

              $eventfield->event_id=$product->id;
                $eventfield->save();

             }
       
            foreach ($languages as $l) {
                $langid = $l['id'] + 1;
                DB::table('product_translations')->insert(array(
                    array(
                        'title' => Input::get('title'),
                        'teaser' => Input::get('teaser'),
                        'slug' => $slug,
                        'description' => Input::get('description'),
                        'product_id' => $product->id,
                        'locale_id' => $langid,
                        'created_at' => \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now()
                    )
                ));
            }

            if (Input::hasFile('pics')) {
                $pics = Input::file('pics');
                foreach ($pics as $pic) {

                    $filename2 = $pic->getClientOriginalName();
                    $path2 = public_path('img/products/' . $filename2);
                    Image::make($pic->getRealPath())->save($path2);
                    $picture = new Picture;
                    $picture->image = 'img/products/' . $filename2;
                    $picture->product_id=$product->id;
                    $picture->save();

                }
            }
            $this->add_activity(Auth::user()->id, 'added new product', 'add');

            return Redirect("all?cat_id=2");

        }

        return Redirect::back()->withErrors($v)->withInput(Input::flash());
    }



    public function step2($product, $step)
    {
        if ($step == 2) {
            return view('products.add_step2', compact('product'));
        } else {
            abort(404);
        }
    }

    public function store_images()
    {
        $file = Input::file('file');
        $product = Input::get('product_id');
        $time = time();

        $filename = $time . "-" . $file->getClientOriginalName();
        $destinationPath = public_path() . '/img/products';

        $upload_success = Input::file('file')->move($destinationPath, $filename);
        $this->imageToDB($destinationPath, $filename, $product);
    }

    public function imageToDB($destinationPath, $filename, $product)
    {
        $product = Product::find($product);
        $picture = new Picture;
        $picture->image = 'img/products/' . $filename;
        $picture->save();
        $product->images()->attach($picture->id);
    }

    public function reviews($slug,$id)
    {

        $input = array(
            'comment' => Input::get('comment'),
            'rating' => Input::get('rating')
        );
        $validator = Validator::make($input, Review::$rules);

        if ($validator->passes()) {

            $review = new Review;
            $review->storeReviewForProduct($id, $input['comment'], $input['rating']);
            return Redirect::to("products/$slug/$id#reviews-anchor")->with('review_posted', true);
        }

        return Redirect::to("products/$slug/$id#reviews-anchor")->withErrors($validator)->withInput(Input::flash());
    }

    public function getSecond()
    {
        $result = array();
        $first = Input::get('first');
        $sub = Subcategory::where('category_id', '=', $first)->get();

        foreach ($sub as $s) {
            $result[$s->id] = $s->name;
        }

        return $result;
    }
    public function getsubsutcategory()
    {
        $result = array();
        $subcat= Input::get('type');

        $subsub = Subcategory::where('parent_sub_category_id', '=', $subcat)->get();

        foreach ($subsub as $s) {
            $result[$s->id] = $s->name;
        }

        return $result;
    }
    public function edit($slug,$id)
    {

        $product = Product::with('pictures')->whereHas('translations', function ($q) use ($slug) {
            $q->where('slug', 'like', '%' . $slug . '%');
        })->get()->first();

        $user_id = $product->user_id;
        $user = User::find(Auth::user()->id);
        $user_role = $user['role']['name'];
        if ($user_id === Auth::user()->id || $user_role=='admin') {
            $category = array();
            $subcategory = array();
            $subsubcategory = array();
            $subsub=array();
            $cat = Category::all();
            foreach ($cat as $c) {
                $category[$c->id] = $c->name;
            }
            $sub = Subcategory::where('parent_sub_category_id', '=', NULL)->where('category_id','=',$product->category_id)->get();

            foreach ($sub as $s) {
                $subcategory[$s->id] = $s->name;
                $subsub = Subcategory::where('parent_sub_category_id', '=', $product->subcategory_id)->get();
            }

            foreach ($sub as $s) {
                $subcategory[$s->id] = $s->name;
            }
            foreach($subsub as $ss){
                $subsubcategory[$ss->id]=$ss->name;
            }


            $type = array();
            $types = App\product_type::all();
            foreach ($types as $t) {
                $type[$t->id] = $t->name;
            }
            $categories=Category::with('translations','subcategories')->whereHas('products', function($q){
                $q->where('status','!=',0);
            })->get();
            return view('products.edit')->with('product', $product)->with('category', $category)->with('subcategories', $subcategory)->with('type',$type)->with('categories',$categories)->with('slug',$slug)->with('id',$id)->with('subsubcategory',$subsubcategory);
        } else {
            return Redirect::back();
        }
    }

    public function update($slug,$id)
    {


        $product = Product::find($id);

        $pictureproduct = Product::with('pictures')->find($id)->pictures;


        $input = Input::all();
        $v = Validator::make($input, Product::$rules);
        $user = User::find(Auth::user()->id);
        $user_role = $user['role']['name'];

        $image = Input::file('image');

   if($image==""){
       $product->thumbnail=$product['thumbnail'];
   }

            if ($product) {
                $product->title = Input::get('title');
                $product->slug = Str::slug(Input::get('title'));
                $product->type_id = Input::get('type_id');
                $product->sub_sub_category_id = Input::get('sub_sub_category_id');
                $product->subcategory_id = Input::get('subcategory_id');
                $product->description = Input::get('description');
                $product->search_keywords = Input::get('search_keywords');
                //$product->price = Input::get('price');
                $product->user_id = Auth::user()->id;
                $product->lat = Input::get('lat');
                $product->lng = Input::get('lng');
                $product->address = Input::get('address');

                  if (Input::file('thumbnail_front')) {

                      $destination = public_path(). "/img/products/$id";
                      if(!file_exists($destination)) File::makeDirectory($destination);

                      $image = Input::file('thumbnail_front');
                      $filename = time() . '.' . $image->getClientOriginalExtension();
                      $destinationPaththumb = public_path(). "/img/products/$id/thumbnails_front/";
                      if(!file_exists($destinationPaththumb)) File::makeDirectory($destinationPaththumb);
                      $product->thumbnail ="img/products/$id/thumbnails_front/" . $filename;
                      $path = public_path("img/products/$id/thumbnails_front/" . $filename);
                      Image::make($image->getRealPath())->save($path);
                  } else {
                      $product->thumbnail = $product['thumbnail'];
                  }

                $product->save();
                $this->add_activity(Auth::user()->id, 'edited product', 'edit');
                return redirect()->back()->withSuccess('The Item is saved successfully','The Item is saved successfully');

        }

    }

    public function delete_product($id)
    {
//        $product = Product::with('images')->find($id);
//        $thumbnail = $product->thumbnail;
//        $images = $product->images;
//        if (File::exists(public_path() . '/' . $thumbnail)) {
//            File::Delete(public_path() . '/' . $thumbnail);
//        }

      /*  foreach ($images as $im) {
            $image = $im->image;
            if (File::exists(public_path() . '/' . $image)) {
                File::Delete(public_path() . '/' . $image);
            }
        }*/
        Product::find($id)->delete();
        $this->add_activity(Auth::user()->id, 'deleted product', 'edit');
        return Redirect::route('myprofile');
    }

    public function removeimg()
    {
        $imgid = Input::get('id');
        if (Picture::find($imgid)->delete()) {
            return 1;
        }

    }

    public function languages()
    {
        $languages = array();
        $locales = DB::table('locales')->get();
        foreach ($locales as $key => $l) {
            $languages[] = array('id' => $key, 'lang' => $l->language);
        }
        return $languages;
    }


    public function addandfind(){
        $subcategoryid=$_GET['subcategoryid'];
        $sub = Product::where('subcategory_id', '=', $subcategoryid)->get();
       return $sub->toJson();
    }
    public function getproductajax(){
        $prod_id=$_GET['prodid'];
        $sub = Product::where('id', '=', $prod_id)->get();
        return $sub->toJson();
    }

    public function getscroll(){
        $perPage = 10;

         $all=\App\Product::with('user')->where('sponsored','!=',1)->where('availability','!=',0)->where('status','!=',0)->get();
        $page = 1;
        if(!empty($_GET["page"])) {
            $page = $_GET["page"];
        }

        $start = ($page-1)*$perPage;
        if($start < 0) $start = 0;

        $query =  $sql . " limit " . $start . "," . $perPage;
        $faq = $db_handle->runQuery($query);

        if(empty($_GET["rowcount"])) {
            $_GET["rowcount"] = $db_handle->numRows($sql);
        }
        $pages  = ceil($_GET["rowcount"]/$perPage);
        $output = '';
        if(!empty($faq)) {
            $output .= '<input type="hidden" class="pagenum" value="' . $page . '" /><input type="hidden" class="total-page" value="' . $pages . '" />';
            foreach($faq as $k=>$v) {
                $output .=  '<div class="question">' . $faq[$k]["question"] . '</div>';
                $output .= '<div class="answer">' . $faq[$k]["answer"] . '</div>';
            }
        }
        print $output;
    }

    public function deletepicture($slug,$productid,$id){

        Picture::find($id)->delete();
        DB::delete('DELETE FROM images WHERE product_id ="'.$id.'" ');
        return Redirect::route('getimages',array($slug, $productid))->withSuccess('The Item deleted successfully','The Item is saved successfully');
    }
    public function searchblog($alias,Request $request){

        $categories=Category::whereHas('translations', function($q) use ($alias)
        {
            $q->where('slug', 'like', '%'.$alias.'%');

        })->get();

        foreach($categories as $c){
            $category_id=$c->id;
        }

        if($request->has('search')){
            $search=$request->get('search');

            $prodtitle=Product::whereHas('translations', function($q) use ($search)
            {
                $q->where('title', 'like', '%'.$search.'%');

            })->get();

            $sort="desc";
            $products=array();
            foreach($prodtitle as $prod){
                $products=Product::whereHas('translations', function($q) use ($search,$category_id)
                {
                    $q->where('title', 'like', '%'.$search.'%');
                    $q->where('category_id', '=', $category_id);

                })->get();

            }

            return view('new_template.client.pages.search_magazine',compact(['alias','products','category_id']));
        }


    }
    public function searchotherblog($slug,Request $request){



        if($request->has('search')){
            $search=$request->get('search');

            $products=Product::whereHas('translations', function($q) use ($search)
            {
                $q->where('title', 'like', '%'.$search.'%');

            })->get();

            return view('new_template.client.pages.search_other',compact(['products','slug']));
        }


    }
    public function add_product_template($id){
        $producttemplate = Product::find($id);

        $locale = Lang::locale();
        $languages = $this->languages();
        foreach ($languages as $key => $l) {
            if ($l['lang'] === $locale) {
                unset($languages[$key]);
            }
        }
        $category_id =$producttemplate['category_id'];
        $subcategory_id =$producttemplate['subcategory_id'];
        $type_id = $producttemplate['type_id'];
        $input = Input::all();

        $v = Validator::make($input, Product::$rules);

            $user = User::find(Auth::user()->id);
            $product = new Product;
            $product->title = Input::get('title');
            $product->teaser = Input::get('teaser');
            $randomnumber = mt_rand(1, 1000);
            $slug = Str::slug(Input::get('title')) . '-' . $randomnumber;
            $product->slug = $slug;
            $product->category_id = $category_id;
            $product->subcategory_id = $subcategory_id;
            $product->type_id = $type_id;
            $product->description = Input::get('description');

            $product->price = Input::get('price');
            $product->availability = Input::get('availability');
            $product->search_keywords = Input::get('search_keywords');
            //$product->price = Input::get('price');
            $product->user_id = $user->id;
            $image = Input::file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('img/products/' . $filename);
            Image::make($image->getRealPath())->save($path);
            $product->thumbnail = 'img/products/' . $filename;
            if ($user->subscribed()) {
                $product->sponsored = 1;
            }
            $thumbnail = Input::file('thumbnail');
            //$thumbnail_back = time() . '.thumbnail_back.' . $thumbnail->getClientOriginalExtension();
            //$path_thumbnail = public_path('img/products/' . $thumbnail_back);
            //Image::make($thumbnail->getRealPath())->save($path_thumbnail);
            //$product->thumbnail_back = 'img/products/' . $thumbnail_back;

           /* $product->lat = Input::get('lat');
            $product->lng = Input::get('lng');
            $product->address = Input::get('address');*/
            if($product->save()){




            foreach ($languages as $l) {
                $langid = $l['id'] + 1;
                DB::table('product_translations')->insert(array(
                    array(
                        'title' => Input::get('title'),
                        'slug' => $slug,
                        'teaser' => Input::get('teaser'),
                        'description' => Input::get('description'),
                        'product_id' => $product->id,
                        'locale_id' => $langid,
                        'created_at' => \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now()
                    )
                ));
            }

         /*   if (Input::hasFile('pics')) {
                $pics = Input::file('pics');
                foreach ($pics as $pic) {

                    $filename2 = $pic->getClientOriginalName();
                    $path2 = public_path('img/products/' . $filename2);
                    Image::make($pic->getRealPath())->save($path2);
                    $picture = new Picture;
                    $picture->image = 'img/products/' . $filename2;
                    $picture->product_id=$product->id;
                    $picture->save();

                }
            }*/
            $this->add_activity(Auth::user()->id, 'added new product', 'add');
            return Redirect::route('product_show',array($product->slug,$product->id."?template=secondsteptemplate"))->withSuccess('The Item is saved successfully','The Item is saved successfully');
            }
        }



}