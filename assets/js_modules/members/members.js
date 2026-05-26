var add_array = [];
var Members = {

	current_page : 0,

	// load preview to modal
	loadPreview: function(id){
		$.ajax({
			method: 'GET',
			url: site_url('members/members/preview/'+ id),
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
	validateFormEditMember: function(){
		this.saveEdit_Member_Form();
		return false;
	},
	validateFormEditฺBranch: function(){
		this.saveEdit_ฺBranch_Form();
		return false;
	},
	validateFormEditฺBranchBackend: function(){
		this.saveEdit_ฺBranch_Backend_Form();
		return false;
	},
	saveFormData: function () {
		var frm_action = site_url('members/members/save');
		var obj = $("#btnConfirmSave");
		if (loading_on(obj) == true) {
			var fdata = $("#formAdd").serialize();
			fdata += "&" + csrf_token_name + "=" + $.cookie(csrf_cookie_name);

			$.ajax({
				method: "POST",
				url: frm_action,
				dataType: "json",
				data: fdata,
				success: function (results) {
					if (results.is_successful) {
						alert_type = "success";
						setTimeout(function(){
							$(window.location).attr('href', site_url('members/members'));
						}, 1500);
					} else {
						alert_type = "danger";
					}
					notify("เพิ่มข้อมูล", results.message, alert_type, "center");
					loading_on_remove(obj);
				},
				error: function (jqXHR, exception) {
					ajaxErrorMessage(jqXHR, exception);
					loading_on_remove(obj);
				},
			});
		}
		return false;
	},
	saveBranchFormData: function () {
		var frm_action = site_url('members/members/saveBranch');
		var obj = $("#btnConfirmSave");
		var member_url = $('input[name="member_url"]').val();
		if (loading_on(obj) == true) {
			var fdata = $("#formAdd").serialize();
			fdata += "&" + csrf_token_name + "=" + $.cookie(csrf_cookie_name);
			$.ajax({
				method: "POST",
				url: frm_action,
				dataType: "json",
				data: fdata,
				success: function (results) {
					if (results.is_successful) {
						alert_type = "success";
						setTimeout(function(){
							if (member_url == 'add_branch_view') {
								$(window.location).attr('href', site_url('members/members'));
							}else{
								$(window.location).attr('href', site_url('index/member_branch'));
							}
						}, 1500);
					} else {
						alert_type = "danger";
					}
					notify("เพิ่มข้อมูล", results.message, alert_type, "center");
					loading_on_remove(obj);
				},
				error: function (jqXHR, exception) {
					ajaxErrorMessage(jqXHR, exception);
					loading_on_remove(obj);
				},
			});
		}
		return false;
	},

	saveEdit_ฺBranch_Form: function(){
		$('#addModal').modal('hide');
		var frm_action = site_url('members/members/update_member_Allbranch');
		var fdata = $('#formEdit').serialize();
		//fdata += '&edit_remark=' + $('#edit_remark').val();
		fdata += '&' + csrf_token_name + '=' + $.cookie(csrf_cookie_name);
		console.log(fdata);
		var obj = $('#btnSaveEditฺBranch');
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
						$(window.location).attr('href', site_url('index/member_branch'));
					}, 1500);
				}else{
					alert_type = 'danger';
				}

				notify('บันทึกข้อมูล', results.message, alert_type, 'center');
				loading_on_remove(obj);

				if(results.is_successful){
				}
			},
			error : function(jqXHR, exception){
				ajaxErrorMessage(jqXHR, exception);
				loading_on_remove(obj);
			}
		});
	},
	saveEdit_ฺBranch_Backend_Form: function(){
		$('#addModal').modal('hide');
		var frm_action = site_url('members/members/update_member_Allbranch');
		var fdata = $('#formEdit').serialize();
		//fdata += '&edit_remark=' + $('#edit_remark').val();
		fdata += '&' + csrf_token_name + '=' + $.cookie(csrf_cookie_name);
		console.log(fdata);
		var obj = $('#btnSaveEditฺBranch');
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
						$(window.location).attr('href', site_url('members/members'));
					}, 1500);
				}else{
					alert_type = 'danger';
				}

				notify('บันทึกข้อมูล', results.message, alert_type, 'center');
				loading_on_remove(obj);

				if(results.is_successful){
				}
			},
			error : function(jqXHR, exception){
				ajaxErrorMessage(jqXHR, exception);
				loading_on_remove(obj);
			}
		});
	},
	saveEdit_Member_Form: function(){
		$('#editModal').modal('hide');
		var frm_action = site_url('members/members/update_member');
		var fdata = $('#formEdit').serialize();
		//fdata += '&edit_remark=' + $('#edit_remark').val();
		fdata += '&' + csrf_token_name + '=' + $.cookie(csrf_cookie_name);
		console.log(fdata);
		var obj = $('#btnSaveEditMember');
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
						$(window.location.reload());
					}, 1500);
				}else{
					alert_type = 'danger';
				}

				notify('บันทึกข้อมูล', results.message, alert_type, 'center');
				loading_on_remove(obj);

				if(results.is_successful){
				}
			},
			error : function(jqXHR, exception){
				ajaxErrorMessage(jqXHR, exception);
				loading_on_remove(obj);
			}
		});
	},
	saveEditForm: function(){
		$('#editModal').modal('hide');
		var frm_action = site_url('members/members/update');
		var fdata = $('#formEdit').serialize();
		//fdata += '&edit_remark=' + $('#edit_remark').val();
		fdata += '&' + csrf_token_name + '=' + $.cookie(csrf_cookie_name);
		console.log(fdata);
		var obj = $('#btnSaveEdit');
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
						$(window.location).attr('href', site_url('members/members'));
					}, 1500);
				}else{
					alert_type = 'danger';
				}

				notify('บันทึกข้อมูล', results.message, alert_type, 'center');
				loading_on_remove(obj);

				if(results.is_successful){
				}
			},
			error : function(jqXHR, exception){
				ajaxErrorMessage(jqXHR, exception);
				loading_on_remove(obj);
			}
		});
	},


	confirmDeleteฺBranch: function (pProductId,  irow){
		$('[name="encrypt_member_branch_id"]').val(pProductId);

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

		$('#confirmDelModalBranch').modal('show');
	},
	confirmDelete: function (pProductId,  irow){
		$('[name="encrypt_member_id"]').val(pProductId);

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
		var frm_action = site_url('members/members/del');
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
						$(window.location).attr('href', site_url('members/members/index/'+ this.current_page));
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
	// delete by ajax jquery
	deleteRecordBranch: function(){
		var frm_action = site_url('members/members/delBranch');
		var fdata = $('#formDelete').serialize();
		fdata += '&' + csrf_token_name + '=' + $.cookie(csrf_cookie_name);
		var obj = $('#btn_confirm_delete_ฺbranch');
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
						$(window.location.reload());
					}, 1500);
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

	$('#btnSave').click(function() {
		$('#addModal').modal('hide');
		Members.saveFormData();
		return false;
	});//click
	$('#btnSaveฺBranch').click(function() {
		$('#addModal').modal('hide');
		Members.saveBranchFormData();
		return false;
	});//click

	$('#btnSaveEdit').click(function() {
		return Members.validateFormEdit();
	});//click
	$('#btnSaveEditMember').click(function() {
		return Members.validateFormEditMember();
	});//click

	$('#btnSaveEditฺBranch').click(function() {
		return Members.validateFormEditฺBranch();
	});//click
	$('#btnSaveEditฺBranchBackend').click(function() {
		return Members.validateFormEditฺBranchBackend();
	});//click

	//List view
	if(typeof param_search_field != 'undefined'){
		$('select[name="search_field"] option[value="'+ param_search_field +'"]').attr('selected','selected');
	}

	if(typeof param_current_page != 'undefined'){
		Members.current_page = Math.abs(param_current_page);
	}


	$(document).on('click','.btn-delete-branch', function(){
		$('.btn-delete-branch').removeClass('active_del');
		$(this).addClass('active_del');
		var row_num = $(this).attr('data-row-number');
		var pProductId = $(this).attr('data-member_branch_id');

		Members.confirmDeleteฺBranch(pProductId,  row_num);
	});//click
	$(document).on('click','.btn-delete-row', function(){
		$('.btn-delete-row').removeClass('active_del');
		$(this).addClass('active_del');
		var row_num = $(this).attr('data-row-number');
		var pProductId = $(this).attr('data-member_id');

		Members.confirmDelete(pProductId,  row_num);
	});//click

	$(document).on('click','#btn_confirm_delete', function(){
		Members.deleteRecord();
	});
	$(document).on('click','#btn_confirm_delete_ฺbranch', function(){
		$('#confirmDelModalBranch').modal('hide');

		Members.deleteRecordBranch();
	});
	setDropdownList('#user_delete');
	setDropdownList('#user_add');
	setDropdownList('#user_update');
	setDropdownList('#fag_allow');

	//Set default value
	var order_by = $('#set_order_by').attr('value');
	$('#set_order_by option[value="'+order_by+'"]').prop('selected', true);

});

$(".file_link").click(function(){
	return false;
});
