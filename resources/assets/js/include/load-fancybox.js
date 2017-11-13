$(document).ready(function() {
	$(".fancybox.ndtimage").fancybox({'type' : 'image'});

	$(".fancybox.ndtpdf").fancybox({
		type		: 'iframe',
		width		: '90%',
		height		: '90%',
	});

	$(".fancybox.ndtiframe").fancybox({
		type		: 'iframe',
		width		: 780,
		height		: '100%',
	});

	$(".fancybox.ndtiframe-wide").fancybox({
		type		: 'iframe',
		width		: '90%',
		height		: '90%',
	});
});