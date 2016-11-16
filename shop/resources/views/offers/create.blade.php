<div class="row profile-products" id="order-create">
    <div class="col-md-12">
        <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/offers/storeoffer') }} " enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">


                <input type="radio" name="order-photos" value="photos" id="show-photo-upload"/> Photos
                <input type="radio" name="order-photos" value="photos" id="show-video-upload"/> Videos

                <input type="file" name="order-photo-upload" id="fileuploadorder"/>
                <input type="text" name="order-video-upload" class="form-control" id="txtvideo" placeholder="{{ Lang::get('app.Add youtube link') }}" style="margin-top:20px;"/>
                <input type="text" name="offer-title" class="form-control" placeholder="{{ Lang::get('app.Title') }}" style="margin-top:20px;"/><br>
                <textarea class="form-control" placeholder="{{ Lang::get('app.Description') }}" name="offer-description"></textarea>

                <div class="col-sm-6 col-sm-offset-6" style="margin-right:20px;margin-top: 20px;">
                    <button type="submit" class="btn btn-success">
                        {{ Lang::get('app.Save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<style>
    input[type=radio] {
        width: 20px;
        height: 20px;
    }
</style>