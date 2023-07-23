$(document).ready(function() {
	$.ajaxSetup({
	    headers: {
	      	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});

	// CKEDITOR.replace( 'full_content', {height: 500 });

	CKEDITOR.on('instanceReady', function () {
	    /*$.each(CKEDITOR.instances, function (instance) {
	        CKEDITOR.instances[instance].document.on("keyup", CK_jQ);
	        CKEDITOR.instances[instance].document.on("paste", CK_jQ);
	        CKEDITOR.instances[instance].document.on("keypress", CK_jQ);
	        CKEDITOR.instances[instance].document.on("blur", CK_jQ);
	        CKEDITOR.instances[instance].document.on("change", CK_jQ);
	    });*/

	    $.each( CKEDITOR.instances, function(instance) {
	        CKEDITOR.instances[instance].on("instanceReady", function() {
	          	this.document.on("keyup", CK_jQ);
	          	this.document.on("paste", CK_jQ);
	          	this.document.on("keypress", CK_jQ);
	          	this.document.on("blur", CK_jQ);
	          	this.document.on("change", CK_jQ);
	        });
	    });

	    $.each( CKEDITOR.instances, function(instance) {
	        CKEDITOR.instances[instance].on("change", function(e) {
	            for ( instance in CKEDITOR.instances )
	            CKEDITOR.instances[instance].updateElement();
	        });
	    });
	});

	function CK_jQ() {
	    for (instance in CKEDITOR.instances) {
	        CKEDITOR.instances[instance].updateElement();
	    }
	}
});

$(window).on('load', function (){
    // $( '.ckeditor' ).ckeditor();
});