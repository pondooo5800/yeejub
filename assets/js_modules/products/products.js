var add_array = [];
var Products = {

	current_page : 0,

	// load preview to modal
	loadPreview: function(id){
		$.ajax({
			method: 'GET',
			url: site_url('products/products/preview/'+ id),
			success: function (results) {
				$('#divPreview').html(results);
			},
			error : function(jqXHR, exception){
				ajaxErrorMessage(jqXHR, exception);
			}
		});
		$('#modalPreview').modal('show');
	},

	validateFormEdit: function(){
		this.saveEditForm();
		return false;
	},

	saveFormData: function(){
		var frm_action = site_url('products/products/save');
		var obj = $('#btnConfirmSave');
		if(loading_on(obj) == true){

			if(!$('#post_iframe').attr('id')){
				var iframe = $('<iframe name="post_iframe" id="post_iframe" style="display: none"></iframe>');
				$("body").append(iframe);
			}

			var form = $('#formAdd');

			form.attr("action", frm_action);
			form.attr("method", "post");

			form.attr("encoding", "multipart/form-data");
			form.attr("enctype", "multipart/form-data");

			form.attr("target", "post_iframe");

			$('[name="'+ csrf_token_name +'"]').val($.cookie(csrf_cookie_name));

			form.submit();

			var c = 0;
			$("#post_iframe").on('load',function() {
				c++;
				if(c==1){

					iframeContents = this.contentWindow.document.body.innerHTML;
					var json_string = iframeContents.toString();
					if(json_string != ""){
						json_string = $("<div/>").html(json_string).text();
						try
						{
							var results = jQuery.parseJSON( json_string );
							console.log(results);
							if(results.is_successful){
								notify('แจ้งเตือน', 'บันทึกข้อมูลเรียบร้อย', 'success', 'center');
								$("#frmUploadDetail :input").attr("disabled", false);
								window.setTimeout(function () {
									$(window.location).attr("href", site_url("products"));
								}, 1300);
							}else{
								notify('เพิ่มข้อมูล', results.message, 'danger', 'center');
							}

							loading_on_remove(obj);

						}
						catch(err)
						{
							alert('Invalid json : ' + err + "\n\n" + json_string);
							loading_on_remove(obj);
						}
					}else{
						alert('การดำเนินการล้มเหลว กรุณาลองใหม่อีกครั้ง');
						loading_on_remove(obj);
					}
				}
			});
		}
		return false;
	},

	saveEditForm: function(){
		$('#editModal').modal('hide');
		var frm_action = site_url('products/products/update');
		if(!$('#post_iframe').attr('id')){
			var iframe = $('<iframe name="post_iframe" id="post_iframe" style="display: none"></iframe>');
			$("body").append(iframe);
		}

		var obj = $('#btnSaveEdit');
		if(loading_on(obj) == true){
			var form = $('#formEdit');

			form.attr("action", frm_action);
			form.attr("method", "post");

			form.attr("encoding", "multipart/form-data");
			form.attr("enctype", "multipart/form-data");

			form.attr("target", "post_iframe");

			$('[name="'+ csrf_token_name +'"]').val($.cookie(csrf_cookie_name));

			form.submit();

			var c = 0;
			$("#post_iframe").on('load',function() {
				c++;
				if(c==1){

					iframeContents = this.contentWindow.document.body.innerHTML;
					var json_string = iframeContents.toString();
					if(json_string != ""){
						json_string = $("<div/>").html(json_string).text();
						try
						{
							var results = jQuery.parseJSON( json_string );
							if(results.is_successful){
								notify('แจ้งเตือน', 'บันทึกข้อมูลเรียบร้อย', 'success', 'center');
								$("#frmUploadDetail :input").attr("disabled", false);
								window.setTimeout(function () {
									$(window.location).attr("href", site_url("products"));
								}, 1300);

							}else{
								notify('เพิ่มข้อมูล', results.message, 'danger', 'center');
							}

							loading_on_remove(obj);

						}
						catch(err)
						{
							alert('Invalid json : ' + err + "\n\n" + json_string);
						}
					}else{
						alert('การดำเนินการล้มเหลว กรุณาลองใหม่อีกครั้ง');
						loading_on_remove(obj);
					}
				}
			});
		}
		return false;
	},

	confirmDelete: function (pProductId,  irow){
		$('[name="encrypt_product_id"]').val(pProductId);

		$('#xrow').text('['+ irow +']');
		var my_thead = $('#row_' + irow).closest('table').find('th:not(:first-child):not(:last-child)');
		var th = [];
		my_thead.each (function(index) {
			th.push($(this).text());
		});

		var active_row = $('#row_' + irow).find('td:not(:first-child):not(:last-child)');
		var detail = '<table class="table table-striped">';
		active_row.each (function(index) {
				detail += '<tr><td align="right"><b>' + th[index] + ' : </b></td><td> ' + $(this).text() + '</td></tr>';
		});
		detail += '</table>';
		$('#div_del_detail').html(detail);

		$('#confirmDelModal').modal('show');
	},

	// delete by ajax jquery
	deleteRecord: function(){
		var frm_action = site_url('products/products/del');
		var fdata = $('#formDelete').serialize();
		fdata += '&' + csrf_token_name + '=' + $.cookie(csrf_cookie_name);
		var obj = $('#btn_confirm_delete');
		loading_on(obj);
		$.ajax({
			method: 'POST',
			url: frm_action,
			dataType: 'json',
			data : fdata,
			success: function (results) {
				if(results.is_successful){
					alert_type = 'success';
					setTimeout(function(){
						$(window.location).attr('href', site_url('products/products/index/'+ this.current_page));
					}, 500);
				}else{
					alert_type = 'danger';
				}
				notify('ลบรายการ', results.message, alert_type, 'center');
				loading_on_remove(obj);
			},
				error : function(jqXHR, exception){
				loading_on_remove(obj);
				ajaxErrorMessage(jqXHR, exception);
			}
		});
	},

}

$(document).ready(function() {
	$(document).on('change','#set_order_by',function(){
		$('input[name="order_by"]').val($(this).val());
		$('button[name="submit"]').click();
	});

	$('#product_img1').change(function(){
		var msg = '';
		var elem_preview = $(this).data('elem-preview');
		var elem_label = $(this).data('elem-label');
		if(this.value == ''){
			msg = 'กรุณาเลือกไฟล์ที่ต้องการอัพโหลด';
		}else{
			msg = this.value;
			previewPicture(this, '#' + elem_preview);
		}
		$('#' + elem_label).val(msg);
	});
    $('#files').change(function() {
		var files = $('#files')[0].files;
		var error = '';
		var form_data = new FormData();
		for (var count = 0; count < files.length; count++) {
		  var name = files[count].name;
		  var extension = name.split('.').pop().toLowerCase();
		  if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
			error += "Invalid " + count + " Image File"
		  } else {
			form_data.append("files[]", files[count]);
		  }
		}
		if (error == '') {
			var frm_action = site_url("products/products/upload");
		  $.ajax({
			url: frm_action, //base_url() return http://localhost/tutorial/codeigniter/
			method: "POST",
			data: form_data,
			contentType: false,
			cache: false,
			processData: false,
			beforeSend: function() {
			  $('#uploaded_images').html("<label style='text-center' class='text-warning'>Uploading</label>");
			},
			success: function(data) {
				$('#uploaded_images').html("<label style='text-center' class='text-success'>Success</label>");

				notify(
					"แจ้งเตือน",
					"บันทึกข้อมูลเรียบร้อย",
					"success",
					"right",
					"bottom"
				);
			  $('#files').val('');
			}
		  })
		} else {
		  alert(error);
		}
	  });

	$('#btnSave').click(function() {
		$('#addModal').modal('hide');
		Products.saveFormData();
		return false;
	});//click

	$('#btnSaveEdit').click(function() {
		return Products.validateFormEdit();
	});//click

	//List view
	if(typeof param_search_field != 'undefined'){
		$('select[name="search_field"] option[value="'+ param_search_field +'"]').attr('selected','selected');
	}

	if(typeof param_current_page != 'undefined'){
		Products.current_page = Math.abs(param_current_page);
	}


	$(document).on('click','.btn-delete-row', function(){
		$('.btn-delete-row').removeClass('active_del');
		$(this).addClass('active_del');
		var row_num = $(this).attr('data-row-number');
		var pProductId = $(this).attr('data-product_id');

		Products.confirmDelete(pProductId,  row_num);
	});//click

	$(document).on('click','#btn_confirm_delete', function(){
		Products.deleteRecord();
	});
	setDropdownList('#user_delete');
	setDropdownList('#user_add');
	setDropdownList('#user_update');
	setDropdownList('#fag_allow');
	setDropdownList('#product_type');
	setDropdownList('#product_unit_id');
	setDropdownList('#banner_type');
	setDropdownList('#product_pro_id');

	//Set default value
	var order_by = $('#set_order_by').attr('value');
	$('#set_order_by option[value="'+order_by+'"]').prop('selected', true);

	//Set default selected
	setDatePicker('.datepicker');

});

$(document).ready(function() {

	$('#p_b_u').on('show.bs.modal', function(e) {
		var rowId = $(e.relatedTarget).data('row-id');
        console.log(rowId);
        var product_code = 'รหัสสินค้า ' + rowId.product_code;
        var promotion_name = rowId.promotion_name;
        var banner_type = rowId.banner_name;
        var product_unit_id = rowId.product_unit_name;
        var product_type = rowId.product_type_name;

        var record_product_id = rowId.record_product_id;
		document.getElementById("text_product_code").innerHTML = product_code;
		document.getElementById("text_promotion_name").innerHTML = promotion_name;
		document.getElementById("text_banner_type").innerHTML = banner_type;
		document.getElementById("text_product_unit_id").innerHTML = product_unit_id;
		document.getElementById("text_product_type").innerHTML = product_type;
		$(".product_pro_id").on("change", function () {
			var frm_action = site_url("products/products/updateAjax");
			var id = record_product_id;
			var item = this.value;
			$.ajax({
				type: "POST",
				url: frm_action,
				dataType: "json",
				data: {
					id: id,
					product_pro_id: item,
					type: "promotion",
				},
				success: function (data) {
					notify(
						"แจ้งเตือน",
						"บันทึกข้อมูลเรียบร้อย",
						"success",
						"right",
						"bottom"
					);
				},
			});
		});
		$(".product_unit_id").on("change", function () {
			var frm_action = site_url("products/products/updateAjax");
			var id = record_product_id;
			var item = this.value;
			$.ajax({
				type: "POST",
				url: frm_action,
				dataType: "json",
				data: {
					id: id,
					product_unit_id: item,
					type: "unit",
				},
				success: function (data) {
					notify(
						"แจ้งเตือน",
						"บันทึกข้อมูลเรียบร้อย",
						"success",
						"right",
						"bottom"
					);
				},
			});
		});
		$(".banner_type").on("change", function () {
			var frm_action = site_url("products/products/updateAjax");
			var id = record_product_id;
			var item = this.value;
			$.ajax({
				type: "POST",
				url: frm_action,
				dataType: "json",
				data: {
					id: id,
					banner_type: item,
					type: "banner",
				},
				success: function (data) {
					notify(
						"แจ้งเตือน",
						"บันทึกข้อมูลเรียบร้อย",
						"success",
						"right",
						"bottom"
					);
				},
			});
		});
		$(".product_type").on("change", function () {
			var frm_action = site_url("products/products/updateAjax");
			var id = record_product_id;
			var item = this.value;
			$.ajax({
				type: "POST",
				url: frm_action,
				dataType: "json",
				data: {
					id: id,
					product_type: item,
					type: "product",
				},
				success: function (data) {
					notify(
						"แจ้งเตือน",
						"บันทึกข้อมูลเรียบร้อย",
						"success",
						"right",
						"bottom"
					);
				},
			});
		});
    });


    $( ".preview-images-zone" ).sortable();

    $(document).on('click', '.image-cancel', function() {

    	let no = $(this).data('no');
		var fdata = 'image_id='+$(this).data('image_id');
		fdata += '&' + csrf_token_name + '=' + $.cookie(csrf_cookie_name);
		$.ajax({
			method: 'POST',
			url: site_url('products/products/deleteProductImage'),
			dataType: 'json',
			data:fdata,
			success: function (results) {
				console.log(results);
        		$(".preview-image.preview-show-"+no).remove();
			},
			error : function(jqXHR, exception){
				ajaxErrorMessage(jqXHR, exception);
			}
		});
    });
});


$(".preview-image img,.file_link img").on("click", function() {
   $('#imagepreview').attr('src', $(this).attr('src')); // here asign the image to the modal when the user click the enlarge link
   $('#imagemodal').modal('show'); // imagemodal is the id attribute assigned to the bootstrap modal, then i use the show function
});
$(".file_link").click(function(){
	return false;
});
