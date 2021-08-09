<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	public function index()
	{
		// $mpdf = new \Mpdf\Mpdf();
		// $html = $this->load->view('welcome_message',[],true);
        // $mpdf->WriteHTML($html);
		// $mpdf->Output();
		$this->load->view('welcome_message');
	}
	public function send()
	{
		$to =  'pondooo5800@gmail.com';  // User email pass here
		$subject = 'Welcome To Elevenstech';

		$from = $this->input->post('from');               // Pass here your mail id

		$emailContent = '<!DOCTYPE><html><head></head><body><table width="600px" style="border:1px solid #cccccc;margin: auto;border-spacing:0;"><tr><td style="background:#000000;padding-left:3%"><img src="http://elevenstechwebtutorials.com/assets/logo/logo.png" width="300px" vspace=10 /></td></tr>';
		$emailContent .= '<tr><td style="height:20px"></td></tr>';


		$emailContent .= $this->input->post('message');  //   Post message available here


		$emailContent .= '<tr><td style="height:20px"></td></tr>';
		$emailContent .= "<tr><td style='background:#000000;color: #999999;padding: 2%;text-align: center;font-size: 13px;'><p style='margin-top:1px;'><a href='http://elevenstechwebtutorials.com/' target='_blank' style='text-decoration:none;color: #60d2ff;'>www.elevenstechwebtutorials.com</a></p></td></tr></table></body></html>";



		$config['protocol'] = 'sendmail';

		$config['mailpath'] = '/usr/sbin/sendmail';

		$config['charset'] = 'iso-8859-1';

		$config['wordwrap'] = TRUE;

		$this->email->initialize($config);


		$this->email->initialize($config);
		$this->email->set_mailtype("html");
		$this->email->from($from);
		$this->email->to($to);
		$this->email->subject($subject);
		$this->email->message($emailContent);
		$this->email->send();

		$this->session->set_flashdata('msg', "Mail has been sent successfully");
		$this->session->set_flashdata('msg_class', 'alert-success');
		return redirect('Welcome');
	}
	public function check_database()
	{
		echo CI_VERSION;
        // phpinfo();

	}
	public function mail(){
        // Load PHPMailer library
        $this->load->library('phpmailer_lib');

        // PHPMailer object
        $mail = $this->phpmailer_lib->load();

        // SMTP configuration
        $mail->isSMTP();
        $mail->Host     = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'poosisom9746@gmail.com';
        $mail->Password = 'pond9746';
        $mail->SMTPSecure = 'ssl';
        $mail->Port     = 25;

        $mail->setFrom('poosisom9746@gmail.com', 'CodexWorld');
        $mail->addReplyTo('poosisom9746@gmail.com', 'CodexWorld');

        // Add a recipient
        $mail->addAddress('pondooo5800@gmail.com');

        // Add cc or bcc
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        // Email subject
        $mail->Subject = 'Send Email via SMTP using PHPMailer in CodeIgniter';

        // Set email format to HTML
        $mail->isHTML(true);

        // Email body content
        $mailContent = "<h1>Send HTML Email using SMTP in CodeIgniter</h1>
            <p>This is a test email sending using SMTP mail server with PHPMailer.</p>";
        $mail->Body = $mailContent;

        // Send email
        if(!$mail->send()){
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }else{
            echo 'Message has been sent';
        }
    }
 }
