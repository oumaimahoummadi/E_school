
$(document).ready(function(){
  // nav slide toggle
	$( "i.icon" ).click(function() {
		$( ".nav-list" ).slideToggle( "slow" );
	});
});

// stickey navbar

$(window).scroll(function(){
  var sc=$(this).scrollTop();
  if(sc>50){
    $('header').addClass('sticky');
  }else{
    $('header').removeClass('sticky');
  }
});