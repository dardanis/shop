@extends('new_template.client.layouts.user_backend')

@section('head')

	<style type="text/css">

		.iframe-responsive-wrapper {
			position: relative;
		}

		.iframe-responsive-wrapper .iframe-ratio {
			display: block;
			width: 100%;
			height: auto;
		}

		.iframe-responsive-wrapper iframe {
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
		}
		
		#page-wrapper {
			background-color: #222;
		}

		.page-header {
			color: #ddd;
		}

	</style>

@stop

