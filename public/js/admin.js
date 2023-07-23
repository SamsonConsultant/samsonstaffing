$(document).ready(function() {
	$.ajaxSetup({
	    headers: {
	      	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});

	 $("#select-all").click(function () {
        $('.selectone:checkbox').not(this).prop('checked', this.checked);
    });

	$("#create-form, #password-form").on('submit',function(e){
	    e.preventDefault();
	    var form = $(this);
	    let formData = new FormData(this);
	    var curSubmit = $(this).find("button.add-podcast-btn");

    	// toastr.options.timeOut = 10000;
    	toastr.options ={
           "closeButton" : true,
           "progressBar" : true,
           "disableTimeOut" : true,
       	}
	    
	    $.ajax({
	        type : 'post',
	        url : form.attr('action'),
	        data : formData,
	        dataType: 'json',
	        contentType: false,
	        processData: false,
	        beforeSend : function(){
	            curSubmit.html(`Sending.. <i class="fa fa-spinner fa-spin"></i>`).attr('disabled',true);
	        },
	        success : function(response){
	        	if(response.status==201){
	        		// $('.error-msg').html(`<div class="alert alert-success alert-dismissible">
	        		//     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	        		//     ${response.message}    
	        		// </div>`);
	        		curSubmit.html(`Save`).attr('disabled',false);
	        		toastr.success(response.message);
	        		document.getElementById("create-form").reset();
	        		$('input[type="text"],texatrea, select', this).val('');

	        		setTimeout(function () {	        		    
	        		    var url = $('#redirect_url').val();
	        		    if(url !== undefined || url != null){
	        		    	window.location = url;
	        		    } else {
	        		    	location.reload(true);
	        		    }
	        		}, 2000);

	        		return false;
	        	}

	        	if(response.status==200){
	        	    // $('.error-msg').html(`<div class="alert alert-danger alert-dismissible">
	        	    //     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	        	    //     ${response.message}    
	        	    // </div>`);
	        	    curSubmit.html(`Save`).attr('disabled',false);
	        	    toastr.error(response.message);
	        	    return false;
	        	}
	        },
	        error : function(data){
	            if(data.status==422){
	            	let li_htm = '';
	                $.each(data.responseJSON.errors,function(k,v){
	                    const $input = form.find(`input[name=${k}],select[name=${k}],textarea[name=${k}]`);                
	                    if($input.next('small').length){
	                        $input.next('small').html(v);
	                        if(k == 'services' || k == 'membership'){
	                        	$('#myselect').next('small').html(v);
	                        }
	                    }else{
	                        $input.after(`<small class='text-danger'>${v}</small>`);
	                        if(k == 'services' || k == 'membership'){
	                        	$('#myselect').after(`<small class='text-danger'>${v[0]}</small>`);
	                        }
	                    }
	                    li_htm += `<li>${v}</li>`;
	                });
	                curSubmit.html(`Save`).attr('disabled',false);
	                return false;
	            }else{
	                // $('.error-msg').html(`<div class="alert alert-danger alert-dismissible">
	                //     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	                //     ${data.statusText}    
	                // </div>`);
	                curSubmit.html(`Save`).attr('disabled',false);
	                toastr.error(data.statusText);
	                return false;
	            }
	        }
	    });
	});

	$("#job-add-experince").click(function () {
	    var html = '';
	    html += '<div id="inputFormRow" class="row border-top">';
	    html += '<div class="col-md-6"><div class="form-group"><label>Company Name <span aria-hidden="true" class="labelRequiredIcon"> *</span></label><input type="text" class="form-control" placeholder="Enter ..." name="company_name[]"></div></div>';

	    html += '<div class="col-md-6"><div class="form-group"><label>Position Title <span aria-hidden="true" class="labelRequiredIcon"> *</span></label><input type="text" class="form-control" placeholder="Enter ..." name="position_title[]"></div></div>';

	    html += '<div class="col-md-6"><div class="form-group"><label>Is current position? <span aria-hidden="true" class="labelRequiredIcon"> *</span></label><input type="text" class="form-control" placeholder="Enter ..." name="current_position[]"></div></div>';

	    html += '<div class="col-md-6"><div class="form-group"><label>Start Date <span aria-hidden="true" class="labelRequiredIcon"> *</span></label><input type="date" class="form-control" placeholder="Enter ..." name="start_date[]"></div></div>';

	    html += '<div class="col-md-6"><div class="form-group"><label>End Date <span aria-hidden="true" class="labelRequiredIcon"> *</span></label><input type="date" class="form-control" placeholder="Enter ..." name="end_date[]"></div></div>';

	    html += '<div class="col-md-6"><div class="form-group"><label>Experience In Year <span aria-hidden="true" class="labelRequiredIcon"> *</span></label><input type="number" class="form-control" placeholder="Enter ..." name="exp_year[]" min="0" max="30"></div></div>';

	    html += '<div class="col-md-6"><div class="form-group"><label>Experience In Month <span aria-hidden="true" class="labelRequiredIcon"> *</span></label><input type="number" class="form-control" placeholder="Enter ..." name="exp_month[]" min="0" max="11"></div></div>';

	    html += '<div class="col-md-3"><div class="form-group"><a href="javascript::void(0)" class="btn-add btn-danger" id="removeRow">Remove</a></div></div>';
	    html += '</div>';

	    $('#new-experince').append(html);
	});

	$("#job-add-education").click(function () {
	    var html = '';
	    html += '<div id="inputFormRow" class="row border-top">';
	    html += '<div class="col-md-6"><div class="form-group"><label>College Name <span aria-hidden="true" class="labelRequiredIcon"> *</span></label><input type="text" class="form-control" placeholder="Enter ..." name="college_name[]"></div></div>';

	    html += '<div class="col-md-6"><div class="form-group"><label>Degree Name <span aria-hidden="true" class="labelRequiredIcon"> *</span></label><input type="text" class="form-control" placeholder="Enter ..." name="degree_name[]"></div></div>';

	    html += '<div class="col-md-6"><div class="form-group"><label>University <span aria-hidden="true" class="labelRequiredIcon"> *</span></label><input type="text" class="form-control" placeholder="Enter ..." name="university_name[]"></div></div>';

	    html += '<div class="col-md-6"><div class="form-group"><label>Start Date <span aria-hidden="true" class="labelRequiredIcon"> *</span></label><input type="date" class="form-control" placeholder="Enter ..." name="ed_start_date[]"></div></div>';

	    html += '<div class="col-md-6"><div class="form-group"><label>End Date <span aria-hidden="true" class="labelRequiredIcon"> *</span></label><input type="date" class="form-control" placeholder="Enter ..." name="ed_end_date[]"></div></div>';

	    html += '<div class="col-md-3"><div class="form-group"><a href="javascript::void(0)" class="btn-add btn-danger" id="removeRow">Remove</a></div></div>';
	    html += '</div>';

	    $('#new-education').append(html);
	});

	// remove row
    $(document).on('click', '#removeRow', function () {
        $(this).closest('#inputFormRow').remove();
    });

	$("#admin-frm-data").on('submit',function(e){
	    e.preventDefault();
	    var form = $(this);
	    let formData = new FormData(this);
	    var curSubmit = $(this).find("button.add-podcast-btn");
    	toastr.options ={
           "closeButton" : true,
           "progressBar" : true,
           "disableTimeOut" : true,
       	}
	    
	    $.ajax({
	        type : 'post',
	        url : form.attr('action'),
	        data : formData,
	        dataType: 'json',
	        contentType: false,
	        processData: false,
	        beforeSend : function(){
	            curSubmit.html(`Sending.. <i class="fa fa-spinner fa-spin"></i>`).attr('disabled',true);
	        },
	        success : function(response){
	        	if(response.status==201){	        		
	        		curSubmit.html(`Save`).attr('disabled',false);
	        		toastr.success(response.message);	        		
	        		setTimeout(function () {
	        		    location.reload(true);
	        		}, 1000);

	        		return false;
	        	}

	        	if(response.status==200){	        	    
	        	    curSubmit.html(`Save`).attr('disabled',false);
	        	    toastr.error(response.message);
	        	    return false;
	        	}
	        },
	        error : function(data){
	            if(data.status==422){
	            	let li_htm = '';
	                $.each(data.responseJSON.errors,function(k,v){
	                    const $input = form.find(`input[name=${k}],select[name=${k}],textarea[name=${k}]`);                
	                    if($input.next('small').length){
	                        $input.next('small').html(v);
	                        if(k == 'services' || k == 'membership'){
	                        	$('#myselect').next('small').html(v);
	                        }
	                    }else{
	                        $input.after(`<small class='text-danger'>${v}</small>`);
	                        if(k == 'services' || k == 'membership'){
	                        	$('#myselect').after(`<small class='text-danger'>${v[0]}</small>`);
	                        }
	                    }
	                    li_htm += `<li>${v}</li>`;
	                });

	                $('.error-msg').html(`<div class="alert alert-danger alert-dismissible">
	                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><ul>
	                    ${li_htm}    
	                </ul></div>`);
	                curSubmit.html(`Save`).attr('disabled',false);
	                return false;
	            }else{	                
	                curSubmit.html(`Save`).attr('disabled',false);
	                toastr.error(data.statusText);
	                return false;
	            }
	        }
	    });
	});

	// send bulk mail js...
	$("#mail_send").click(function () {
	    if($('.selectone:checkbox:checked').length < 1) {
	        alert('Please select at least one checkbox');
	        return false;
	    } else {
	    	var items = [];
			$("input[name='jobm_ids[]']:checked").each(function(){items.push($(this).val());});
			$("#items_id").val(items.join(","));
			$("#bulkMail").modal('show');			
	    }
	});
	
	$("#send-bulk-mail").on('submit',function(e){
	    e.preventDefault();
	    var form = $(this);
	    let formData = new FormData(this);
	    var curSubmit = $(this).find("button#bulk_mail_send");
    	toastr.options ={
           "closeButton" : true,
           "progressBar" : true,
           "disableTimeOut" : true,
       	}
	    
	    $.ajax({
	        type : 'post',
	        url : form.attr('action'),
	        data : formData,
	        dataType: 'json',
	        contentType: false,
	        processData: false,
	        beforeSend : function(){
	            curSubmit.html(`Sending.. <i class="fa fa-spinner fa-spin"></i>`).attr('disabled',true);
	        },
	        success : function(response){
	        	if(response.status==201){	        		
	        		curSubmit.html(`Send Mail`).attr('disabled',false);
	        		toastr.success(response.message);	        		
	        		setTimeout(function () {
	        		    location.reload(true);
	        		}, 1000);

	        		return false;
	        	}

	        	if(response.status==200){	        	    
	        	    curSubmit.html(`Send Mail`).attr('disabled',false);
	        	    toastr.error(response.message);
	        	    return false;
	        	}
	        },
	        error : function(data){
	            if(data.status==422){
	            	let li_htm = '';
	                $.each(data.responseJSON.errors,function(k,v){	                    
	                    li_htm += `<li>${v}</li>`;
	                });

	                $('.mail-error-msg').html(`<div class="alert alert-danger alert-dismissible">
	                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><ul>
	                    ${li_htm}    
	                </ul></div>`);
	                curSubmit.html(`Send Mail`).attr('disabled',false);
	                return false;
	            }else{	                
	                curSubmit.html(`Send Mail`).attr('disabled',false);
	                toastr.error(data.statusText);
	                return false;
	            }
	        }
	    });
	});

	// remove row
    $(document).on('click', '.inter-btn', function () {
        var id = $(this).attr('data-id');
        var usr = $(this).attr('data-user');
        $('.job_mg_id').val(id);
        if(usr){
        	$('#user_name').val(usr);
        }
    });

    $("#inter-frm-data").on('submit',function(e){
	    var form = $(this);
	    let formData = new FormData(this);
	    var curSubmit = $(this).find("button#inter_send");
    	toastr.options ={
           "closeButton" : true,
           "progressBar" : true,
           "disableTimeOut" : true,
       	}
	    
	    $.ajax({
	        type : 'post',
	        url : form.attr('action'),
	        data : formData,
	        dataType: 'json',
	        contentType: false,
	        processData: false,
	        beforeSend : function(){
	            curSubmit.html(`Sending.. <i class="fa fa-spinner fa-spin"></i>`).attr('disabled',true);
	        },
	        success : function(response){
	        	if(response.status==201){	        		
	        		curSubmit.html(`Send`).attr('disabled',false);
	        		toastr.success(response.message);	        		
	        		setTimeout(function () {
	        		    location.reload(true);
	        		}, 1000);

	        		return false;
	        	}

	        	if(response.status==200){	        	    
	        	    curSubmit.html(`Send`).attr('disabled',false);
	        	    toastr.error(response.message);
	        	    return false;
	        	}
	        },
	        error : function(data){
	            if(data.status==422){
	            	let li_htm = '';
	                $.each(data.responseJSON.errors,function(k,v){	                    
	                    li_htm += `<li>${v}</li>`;
	                });

	                $('.inter-error-msg').html(`<div class="alert alert-danger alert-dismissible">
	                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><ul>
	                    ${li_htm}    
	                </ul></div>`);
	                curSubmit.html(`Send`).attr('disabled',false);
	                return false;
	            }else{	                
	                curSubmit.html(`Send`).attr('disabled',false);
	                toastr.error(data.statusText);
	                return false;
	            }
	        }
	    });

	    e.preventDefault();	    
	});

    $("#selection-frm-data").on('submit',function(e){
	    e.preventDefault();
	    var form = $(this);
	    let formData = new FormData(this);
	    var curSubmit = $(this).find("button#selection_send");
    	toastr.options ={
           "closeButton" : true,
           "progressBar" : true,
           "disableTimeOut" : true,
       	}
	    
	    $.ajax({
	        type : 'post',
	        url : form.attr('action'),
	        data : formData,
	        dataType: 'json',
	        contentType: false,
	        processData: false,
	        beforeSend : function(){
	            curSubmit.html(`Sending.. <i class="fa fa-spinner fa-spin"></i>`).attr('disabled',true);
	        },
	        success : function(response){
	        	if(response.status==201){	        		
	        		curSubmit.html(`Send`).attr('disabled',false);
	        		toastr.success(response.message);	        		
	        		setTimeout(function () {
	        		    location.reload(true);
	        		}, 1000);

	        		return false;
	        	}

	        	if(response.status==200){	        	    
	        	    curSubmit.html(`Send`).attr('disabled',false);
	        	    toastr.error(response.message);
	        	    return false;
	        	}
	        },
	        error : function(data){
	            if(data.status==422){
	            	let li_htm = '';
	                $.each(data.responseJSON.errors,function(k,v){	                    
	                    li_htm += `<li>${v}</li>`;
	                });

	                $('.selection-error-msg').html(`<div class="alert alert-danger alert-dismissible">
	                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><ul>
	                    ${li_htm}    
	                </ul></div>`);
	                curSubmit.html(`Send`).attr('disabled',false);
	                return false;
	            }else{	                
	                curSubmit.html(`Send`).attr('disabled',false);
	                toastr.error(data.statusText);
	                return false;
	            }
	        }
	    });
	});

	$("#admin-form").on('submit',function(e){
	    e.preventDefault();
	    var form = $(this);
	    let formData = new FormData(this);
	    var curSubmit = $(this).find("button.add-podcast-btn");

    	// toastr.options.timeOut = 10000;
    	toastr.options ={
           "closeButton" : true,
           "progressBar" : true,
           "disableTimeOut" : true,
       	}
	    
	    $.ajax({
	        type : 'post',
	        url : form.attr('action'),
	        data : formData,
	        dataType: 'json',
	        contentType: false,
	        processData: false,
	        beforeSend : function(){
	            curSubmit.html(`Sending.. <i class="fa fa-spinner fa-spin"></i>`).attr('disabled',true);
	        },
	        success : function(response){
	        	if(response.status==201){
	        		curSubmit.html(`Save`).attr('disabled',false);
	        		toastr.success(response.message);	        		
	        		setTimeout(function () {	        		    
	        		    var list_url = $('#redirect_url').val();
	        		    if(typeof list_url !== 'undefined'){
	        		    	window.location = list_url;
	        		    } else {
	        		    	location.reload(true);
	        		    }
	        		}, 1000);

	        		return false;
	        	}

	        	if(response.status==200){	        	    
	        	    curSubmit.html(`Save`).attr('disabled',false);
	        	    toastr.error(response.message);
	        	    return false;
	        	}
	        },
	        error : function(data){
	            if(data.status==422){
	            	let li_htm = '';
	                $.each(data.responseJSON.errors,function(k,v){
	                    const $input = form.find(`input[name=${k}],select[name=${k}],textarea[name=${k}]`);                
	                    if($input.next('small').length){
	                        $input.next('small').html(v);
	                        if(k == 'services' || k == 'membership'){
	                        	$('#myselect').next('small').html(v);
	                        }
	                    }else{
	                        $input.after(`<small class='text-danger'>${v}</small>`);
	                        if(k == 'services' || k == 'membership'){
	                        	$('#myselect').after(`<small class='text-danger'>${v[0]}</small>`);
	                        }
	                    }
	                    li_htm += `<li>${v}</li>`;
	                });

	                $('.error-msg').html(`<div class="alert alert-danger alert-dismissible">
	                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	                    ${li_htm}    
	                </div>`);
	                curSubmit.html(`Save`).attr('disabled',false);
	                return false;
	            }else{	                
	                curSubmit.html(`Save`).attr('disabled',false);
	                toastr.error(data.statusText);
	                return false;
	            }
	        }
	    });
	});
});