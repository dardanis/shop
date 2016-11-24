<?php

namespace App\Http\Controllers;

use App\Video;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $video = Video::all();

        return view('profile.video', [
            'video' => $video
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Requests\VideoRequest $request)
    {

        preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/",
            $request->get('url'), $matches);

        $user = auth()->user();

        $image = $request->get('url');
        $query_string = array();

        parse_str(parse_url($image, PHP_URL_QUERY), $query_string);

        $image = $query_string["v"];

        // get the corresponding thumbnail images
        $thumbnail = "http://img.youtube.com/vi/" . $image . "/0.jpg";


        $video = new Video();
        $video->title = $request->get('title');
        $video->user_id = $user->id;
        $video->description = $request->get('description');
        $video->url = $matches[1];
        $video->thumbnail = $thumbnail;
        $video->save();

        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
