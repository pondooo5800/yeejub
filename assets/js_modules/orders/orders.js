var add_array = [];
var Orders = {

	current_page : 0,

	// load preview to modal
	loadPreview: function(id){
		$.ajax({
			method: 'GET',
			url: site_url('orders/orders/preview/'+ id),
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
		var frm_action = site_url('orders/orders/save');
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
									$(window.location).attr("href", site_url("orders"));
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
		var frm_action = site_url('orders/orders/update');
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
									$(window.location).attr("href", site_url("orders"));
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

	confirmDelete: function (pOrderId,  irow){
		$('[name="encrypt_id"]').val(pOrderId);

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
		var frm_action = site_url('orders/orders/del');
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
						$(window.location).attr('href', site_url('orders/orders/index/'+ this.current_page));
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
	$('#p_b_u').on('show.bs.modal', function(e) {
		var rowId = $(e.relatedTarget).data('row-id');
        console.log(rowId);
        var order_code = 'เลขที่ใบสั่งซื้อ ' + rowId.id;
        var customer_id = 'รหัสสมาชิก ' + rowId.customer_id;
        var status = 'สถานนะ : ' + rowId.status;
        var record_id = rowId.id;
        var record_order = rowId.encrypt_id;
		document.getElementById("text_order_code").innerHTML = order_code;
		document.getElementById("text_customer_id").innerHTML = customer_id;
		document.getElementById("text_status").innerHTML = status;
		$(".status").on("change", function () {
			var frm_action = site_url("orders/orders/updateAjax");
			var encrypt_id = record_order;
			var id = record_id;
			// console.log(encrypt_id);
			var item = this.value;
			$.ajax({
				type: "POST",
				url: frm_action,
				dataType: "json",
				data: {
					id: id,
					encrypt_id: encrypt_id,
					status: item,
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

	$('#btnSave').click(function() {
		$('#addModal').modal('hide');
		Orders.saveFormData();
		return false;
	});//click

	$('#btnSaveEdit').click(function() {
		return Orders.validateFormEdit();
	});//click

	//List view
	if(typeof param_search_field != 'undefined'){
		$('select[name="search_field"] option[value="'+ param_search_field +'"]').attr('selected','selected');
	}

	if(typeof param_current_page != 'undefined'){
		Orders.current_page = Math.abs(param_current_page);
	}


	$(document).on('click','.btn-delete-row', function(){
		$('.btn-delete-row').removeClass('active_del');
		$(this).addClass('active_del');
		var row_num = $(this).attr('data-row-number');
		var pOrderId = $(this).attr('data-id');

		Orders.confirmDelete(pOrderId,  row_num);
	});//click

	$(document).on('click','#btn_confirm_delete', function(){
		Orders.deleteRecord();
	});
	setDropdownList('#user_delete');
	setDropdownList('#user_add');
	setDropdownList('#user_update');
	setDropdownList('#fag_allow');
	setDropdownList('#status');

	//Set default value
	var order_by = $('#set_order_by').attr('value');
	$('#set_order_by option[value="'+order_by+'"]').prop('selected', true);

	//Set default selected
	setDatePicker('.datepicker');

});

$(".file_link").click(function(){
	return false;
});
