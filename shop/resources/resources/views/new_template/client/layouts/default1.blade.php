<!DOCTYPE html>
<html lang="en">
<head>
@include('new_template.client.includes.head')

</head>

<body>


	<header>

		@include('new_template.client.includes.header')


	</header>

	@yield('content')


	<!-- include js files -->

	<script src="{{ asset('/js/libs/jquery-1.11.1.min.js') }}"></script>
	<script src="{{ asset('/js/libs/jquery-ui-1.10.4.custom.min.js') }}"></script>
	<script src="{{ asset('/js/libs/jquery.easing.min.js') }}"></script>
	<script src="{{ asset('/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('/js/pluginstheme/smoothscroll.js') }}"></script>
	<script src="{{ asset('/js/pluginstheme/jquery.validate.min.js') }}"></script>
	<script src="{{ asset('/js/pluginstheme/icheck.min.js') }}"></script>
	<script src="{{ asset('/js/pluginstheme/jquery.placeholder.js') }}"></script>
	<script src="{{ asset('/js/pluginstheme/jquery.stellar.min.js') }}"></script>
	<script src="{{ asset('/js/pluginstheme/jquery.touchSwipe.min.js') }}"></script>
	<script src="{{ asset('/js/pluginstheme/jquery.shuffle.min.js') }}"></script>
	<script src="{{ asset('/js/pluginstheme/lightGallery.min.js') }}"></script>
	<script src="{{ asset('/js/pluginstheme/owl.carousel.min.js') }}"></script>
	<script src="{{ asset('/js/pluginstheme/masterslider.min.js') }}"></script>
	<script src="{{ asset('/mailer/mailer.js') }}"></script>
	<script src="{{ asset('/js/scripts.js ') }}"></script>
	<script src="{{ asset('/js/review.js ') }}"></script>

</body>
</html>
<script>
	$(function() {
		$('#locale').change(function() {
			this.form.submit();
		});
	});
</script>

