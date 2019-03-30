$(document).ready(function(){
	
	  // Pay Period Change
    $('#radioBtn span').on('click', function(){
        let sel = $(this).data('value');
        let tog = $(this).data('toggle');
        $('#'+tog).val(sel);
        $('span[data-toggle="'+tog+'"]').not('[data-value="'+sel+'"]').removeClass('active btn-success').addClass('notActive btn-default');
        $('span[data-toggle="'+tog+'"][data-value="'+sel+'"]').removeClass('notActive btn-default').addClass('active btn-success');
    });
	
	$("#numberOfUser").on('change', function() {
		let price = $(this).data('role');
		let value = $("#numberOfUser option:selected").val();
		$('#numberOfUserPrice').text('£ '+value*price);
		$('#totalOfUserPrice').text('£ '+value*price);
		
	});
	
	$('button.choosePlan').on('click', function(){
		 let plan = $(this).data('id');
		 $('#choosedId').val(plan);
		 $('#submitPlans').submit();
    });
    // load more price-box items
    if($('.pricing').length > 0) {
        $('.load-more').click(function() {
            $('.pricing ul li').removeClass('hide-element');
            $('.load-more').hide();
        });
    }
	$('span[data-toggle="estado"][data-value="annually"]').click(function() {
		$('.monthlyprice').addClass('hide-element');
		$('.annuallyprice').removeClass('hide-element');
	});
 	$('span[data-toggle="estado"][data-value="monthly"]').click(function() {
		$('.monthlyprice').removeClass('hide-element');
		$('.annuallyprice').addClass('hide-element');
	});
 
    /*-------------------------------------------
	toastr.js
    --------------------------------------------- */
    toastr.options = {
        "positionClass": "toast-bottom-left"
    };


	$('.paypal-process').modal({
	  keyboard: false,
	  backdrop: 'static',
	  show:false
	});
 
	$("#billingPaymentDetails").validate({
		
		highlight: function(element) {
			$(element).closest('div').addClass("has-error has-danger");
		},
		unhighlight: function(element) {
			$(element).closest('div').removeClass("has-error has-danger");
		},
		errorPlacement: function(error, element) {
			error.appendTo( element.next("div.with-errors") );
		},
		invalidHandler: function(event, validator) {
			var errors = validator.numberOfInvalids();
			if (errors) {
				toastr.error('Please fill out the blank.');
			}
		},
		submitHandler: function (form) {
			$('.paypal-process').modal('show');
			let formdata = $(form).serialize();
			let url = $(form).attr('action');
			$.ajax({
				url:url,
				dataType: 'json',
				type: 'POST',
				cache:false ,
				data: formdata,
				success: function(data){
					if(data.status){
						if(data.status=='success'){
						   window.location.href = data.approvalUrl;
						}else{
							toastr.error(data.message);
						}
						
					}
					
				}
			})
		},
		
	});
});