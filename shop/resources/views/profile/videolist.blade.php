{{--@extends('new_template.client.layouts.default')--}}
{{--@section('content')--}}
    <div class="bs-example">
        <!-- Button HTML (to Trigger Modal) -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" data-title="Feedback">
            Add Video
        </button>

        <!-- Modal HTML -->
        <div id="myModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Modal Window</h4>
                    </div>
                    <div class="modal-body">
                        <form role="form" method="POST"
                              action="{!! action('VideoController@store') !!}">
                            <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>

                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Title:</label>
                                <input type="text" name="title" class="form-control" id="recipient-name">
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Url:</label>
                                <input type="text" name="url" class="form-control" id="recipient-name">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label">Description:</label>
                                <textarea class="form-control" name="description" id="message-text"></textarea>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-9">
        <div class="row">
            <div id="loading"></div>
            <div class="col-xs-12">
                <h3>Video</h3>
                <ul>
                    @foreach($video as $vid)
                        <div class="items col-md-4 col-xs-6">
                            <div class="title">
                                <p>{{$vid->title}}</p>
                            </div>
                            <iframe width="300" height="200" src="https://www.youtube.com/embed/{{ $vid->url }}"
                                    frameborder="0" allowfullscreen></iframe>
                            <div class="caption">
                                <p>{{$vid->description}}</p>
                            </div>
                        </div>
                    @endforeach
                </ul>
            </div>

        </div>
    </div>
@endsection
