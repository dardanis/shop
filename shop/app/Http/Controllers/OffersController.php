<?php namespace App\Http\Controllers;
use App\Offers;
use Illuminate\Http\Request;
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
use App\Http\Requests\VideoRequest;
class OffersController extends Controller {

    public function languages(){
        $languages=array();
        $locales=DB::table('locales')->get();
        foreach($locales as $key=>$l){
            $languages[]=array('id'=>$key,'lang'=>$l->language);
        }
        return $languages;
    }
    public function index()
    {
        return view('offers.index');
    }


    public function add()
    {
        return view('offers.index');
    }

    /**
     * @param VideoRequest $request
     * @return mixed
     */
    public function store(VideoRequest $request)
    {
       
        $user_id=\App\User::find(Auth::user()->id);
        
        $locale = Lang::locale();

        $languages = $this->languages();

        if ($request->hasFile('order-photo-upload')) {
            $offer=new Offers();
            $offer->user_id=$user_id['id'];

            if($offer->save()){
                $offerimage=\App\Offers::find($offer->id);
                $image = $request->file('order-photo-upload');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $offerimage->image_path="img/offerobject/$offerimage->id/" . $filename;
                $destination = public_path(). "/img/offerobject/$offerimage->id";
                if(!File::exists($destination)) File::makeDirectory($destination);
                $path = public_path("img/offerobject/$offerimage->id/" . $filename);
                Image::make($image->getRealPath())->save($path);
                $offerimage->save();
                $langid=0;
                foreach ($languages as $l) {
                    $langid++;
                    DB::table('offers_translations')->insert(array(
                        array(
                            'title' => $request->get('offer-title'),
                            'description' => $request->get('offer-description'),
                            'offers_id' => $offer->id,
                             'user_id' => $user_id->id,
                            'locale_id' => $langid,
                            'created_at' => \Carbon\Carbon::now(),
                            'updated_at' => \Carbon\Carbon::now()
                        )
                    ));
                }

                return Redirect::route('viewprofile')->with('success','Offer added successfully');
            }

        }
        if (!empty($_POST['order-video-upload'])) {

            preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/",
                $request->get('order-video-upload'), $matches);

            $image = $request->get('order-video-upload');
            $query_string = array();

            parse_str(parse_url($image, PHP_URL_QUERY), $query_string);

            $image = $query_string["v"];

            // get the corresponding thumbnail images
            $thumbnail = "http://img.youtube.com/vi/" . $image . "/0.jpg";

            $offer=new Offers();
            $offer->user_id=$user_id['id'];
            $offer->video= $matches[1];
            $offer->description = $request->get('offer-description');
            $offer->image_path = $thumbnail;
            if($offer->save()){
                foreach ($languages as $l) {
                    $langid = $l['id'] + 1;
                    DB::table('offers_translations')->insert(array(
                        array(
                            'title' => $request->get('offer-title'),
                            'user_id' => $user_id->id,
                            'description' => $request->get('offer-description'),
                            'offers_id' => $offer->id,
                            'locale_id' => $langid,
                            'created_at' => \Carbon\Carbon::now(),
                            'updated_at' => \Carbon\Carbon::now()
                        )
                    ));
                }
                return Redirect::route('viewprofile')->with('success','Offer added successfully');
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
        $area= \Illuminate\Support\Facades\DB::table('area_details')->where('area_id', '=',$id)->get();
        return view('areadetails.formupdate')->with('type',$area);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        \Illuminate\Support\Facades\DB::table('area_details')->where('area_id', '=', $id)->delete();
        $type=new AreaDetails();
        $type->area_name=$_POST['area_name'];
        $type->area_alias=$_POST['area_alias'];
        $type->area_description=$_POST['area_description'];
        if($type->save()) {

            return Redirect::route('areaindex')->with('success','Area updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */

    public function delete_area($area_id)
    {

        DB::table('area_details')->where('area_id', $area_id)->delete();

        return Redirect::route('areaindex')->with('success','Type deleted successfully');
    }
    public function destroy($id)
    {
        //
    }

}
