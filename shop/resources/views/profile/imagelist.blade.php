<div class="row search-profile">
    <div class="col-md-12">

        <div class="div-content-category">
            <h2 class="title-category">Images</h2>
            @if(!is_null($image))
            @foreach($image as $img)
                <div class="items col-md-4 col-xs-6">
                    <div class="title">
                        <p>{{$img->title}}</p>
                    </div>
                    <div class="col-md-12">
                        <img src="{{ asset($img->image_path) }}" class="img-responsive" style="max-height:200px"/>
                    </div>
                    <div class="caption">
                        <p>{{$img->description}}</p>
                    </div>
                </div>
            @endforeach
            @endif
            <div class="row col-xs-12 content text-right">
                {!! $image->render() !!}
            </div>
        </div>
    </div>
</div>