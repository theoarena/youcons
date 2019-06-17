@if (Session::has('show_modal'))
	<div class="modal fade" tabindex="-1" role="dialog" id="modal_formhome">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Youcons</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <p>@include( Session::get('modal_view') )</p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-close" data-dismiss="modal">Ok</button>
	      </div>
	    </div>
	  </div>
	</div>

	<script type="text/javascript">
		$('#modal_formhome').modal('show');
	</script>

@endif

@section('footer-script')

<script type="text/javascript">
	var offset = 55;

	$('body').scrollspy({ target: 'header',offset: offset });

	$('header li a.nav-link').click(function(event) {
	    	//event.preventDefault();

     // Make sure this.hash has a value before overriding default behavior
      if (this.hash !== "") {

        // Prevent default anchor click behavior
        event.preventDefault();

        // Store hash
        var hash = this.hash;

        if(hash == '#ajuda')
            $('html, body').animate({
                scrollTop: $(hash).offset().top - 200
            }, 800, 'swing' ,function(){});
        else
            $('html, body').animate({
              scrollTop: $(hash).offset().top - offset
            }, 800, 'swing' ,function(){

        // Add hash (#) to URL when done scrolling (default click behavior)
          //window.location.hash = hash;
        });

      } // End if

	});

	$(document).on("scroll", function(){
		if
      ($(document).scrollTop() > 90){
		  $("header").addClass("shrink");
		}
		else
		{
			$("header").removeClass("shrink");
		}
	});


	$(function () {
	  $('[data-toggle="popover"]').popover(
	  	{
	  		trigger: 'focus'
	  	}
	  	)
	})

	$('#carouselHome').carousel({
	  interval: 5000
	});
</script>

@show