@if(session()->has('success'))
<div class="alert alert-success alert-block fade in">
   <a href="#" class="close" data-dismiss="alert">&times;</a>
    <h4>
        <strong>Success.</strong>
    </h4>

    <p>{!! session('success') !!}</p>
</div>
@endif
@if(session()->has('error'))
    <div class="alert alert-block alert-danger fade in">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <h4>
             Error
        </h4>

        <p>{!! session('error') !!}</p>
    </div>
@endif
@if($errors->any())
<div class="alert alert-danger">
	<a href="#" class="close" data-dismiss="alert">&times;</a>
	<ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif