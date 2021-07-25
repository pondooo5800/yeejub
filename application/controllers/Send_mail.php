<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Send_mail extends CI_Controller {
public function __construct()
	{
		parent::__construct();
	}
	public function send()
	{
		$this->load->library('email');

		$config['mailtype'] = 'html';
		$this->email->initialize($config);

		$name=$this->input->post('name');
		$email=$this->input->post('email');
		$phone_number=$this->input->post('phone_number');
		$msg_subject=$this->input->post('msg_subject');
		$message=$this->input->post('message');

		$this->email->from($email);
		$this->email->to('pondooo5800@gmail.com');

		$datese = date('d/m/Y');
		$message =
		'
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml" lang="en-GB">
		<head>
		  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		  <title>Demystifying Email Design</title>
		  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

		  <style type="text/css">
			a[x-apple-data-detectors] {color: inherit !important;}
		  </style>

		</head>
		<body style="margin: 0; padding: 0;">
		  <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr>
			  <td style="padding: 20px 0 30px 0;">

		<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse; border: 1px solid #cccccc;">
		  <tr>
			<td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
			  <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
				<tr>
				  <td style="color: #153643; font-family: Arial, sans-serif;">
					<h1 style="font-size: 24px; margin: 0;">'.$msg_subject.'</h1>
				  </td>
				</tr>
				<tr>
				  <td style="color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 24px; padding: 20px 0 30px 0;">
					<p style="margin: 0;"> Date : '.$datese.'</p>
					<p style="margin: 0;"> Name : '.$name.'</p>
					<p style="margin: 0;"> Phone Number : '.$phone_number.'</p>
					<p style="margin: 0;"> Message : '.$message.'</p>
				  </td>
				</tr>
			  </table>
			</td>
		  </tr>
		  <tr>
			<td bgcolor="#113261" style="padding: 30px 30px;">
				<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
				<tr>
				  <td style="color: #ffffff; font-family: Arial, sans-serif; font-size: 14px;">
					<p style="margin: 0;">Copyright ©2020 OceanBlueWave.<br/>
				  </td>
				</tr>
			  </table>
			</td>
		  </tr>
		</table>

			  </td>
			</tr>
		  </table>
		</body>
		</html>
		';

		$this->email->subject($msg_subject);
		$this->email->message($message);
		if($this->email->send()){
			$data['result']="Send mail OK";
			$this->load->view('contact',$data);
		}else{
			$data['result']="Not Send";
			$this->load->view('contact',$data);
		}
	}
}