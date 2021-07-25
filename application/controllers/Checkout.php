<?php
if (!defined('BASEPATH'))  exit('No direct script access allowed');

/**
 * [ Controller File name : Checkout.php ]
 */
class Checkout extends CI_Controller
{

	private $data;
	private $per_page;
	private $breadcrumb_data;
	private $left_sidebar_data;
	private $another_js;
	private $another_css;

	public function __construct()
	{
		parent::__construct();
		check_lang();

		$data['base_url'] = base_url();
		$data['site_url'] = site_url();

        $this->load->library('form_validation');
        $this->load->helper('form');

        // Load cart library
        $this->load->library('cart');

        // Load product model
		$this->load->model('product_model', 'product');

        $this->controller = 'checkout';

		$data['csrf_token_name'] = $this->security->get_csrf_token_name();
		$data['csrf_cookie_name'] = $this->config->item('csrf_cookie_name');
		$data['csrf_protection_field'] = insert_csrf_field(true);

		$this->per_page = 12;
		$this->num_links = 6;
		$this->uri_segment = 3;

		$this->data = $data;
		$this->breadcrumb_data = $data;
		$this->left_sidebar_data = $data;

		$this->another_js .= '<script src="' . base_url('assets/themes/sb-admin/vendor/chart.js/Chart.min.js') . '"></script>';
		$this->another_js .= '<script src="' . base_url('assets/themes/sb-admin/js/sb-admin-charts.min.js') . '"></script>';
	}

	// ------------------------------------------------------------------------

	/**
	 * Render this controller page
	 * @param String path of controller
	 * @param Integer total record
	 */
	private function render_view($path)
	{
		$this->data['top_navbar'] = $this->parser->parse('template/majestic/frontendpage_navbar_view', $this->data, TRUE);
		$this->data['page_content'] = $this->parser->parse_repeat($path, $this->data, TRUE);
		$this->data['another_css'] = $this->another_css;
		$this->data['another_js'] = $this->another_js;
		$this->parser->parse('template/majestic/frontendpage_view', $this->data);
	}
	public function create_pagination($page_url, $total)
	{
		$this->load->library('pagination');
		$config['base_url'] = $page_url;
		$config['total_rows'] = $total;
		$config['per_page'] = $this->per_page;
		$config['num_links'] = $this->num_links;
		$config['uri_segment'] = $this->uri_segment;
		$config['attributes'] = array('class' => 'page-link');
		$this->pagination->initialize($config);
		return $this->pagination->create_links();
	}

	public function index()
	{
        // Redirect if the cart is empty
        if($this->cart->total_items() <= 0){
            redirect('products/');
        }

        $custData = $data = array();

        // If order request is submitted
        $submit = $this->input->post('placeOrder');

        if(isset($submit)){
            // Form field validation rules
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('phone', 'Phone', 'required');
            $this->form_validation->set_rules('address', 'Address', 'required');

            // Prepare customer data
            $custData = array(
                'name'     => strip_tags($this->input->post('name')),
                'email'     => strip_tags($this->input->post('email')),
                'phone'     => strip_tags($this->input->post('phone')),
                'address'=> strip_tags($this->input->post('address'))
            );

            // Validate submitted form data
            // print_r($custData);
            // die();

            if($this->form_validation->run() == true){
                // Insert customer data
                $insert = $this->product->insertCustomer($custData);

                // Check customer data insert status
                if($insert){
                    // Insert order
                    $order = $this->placeOrder($insert);

                    // If the order submission is successful
                    if($order){
                        $this->session->set_userdata('success_msg', 'Order placed successfully.');
                        redirect($this->controller.'/orderSuccess/'.$order);
                    }else{
                        $data['error_msg'] = 'Order submission failed, please try again.';
                    }
                }else{
                    $data['error_msg'] = 'Some problems occured, please try again.';
                }
            }
        }

        // Customer data
        $data['custData'] = $custData;

        // Retrieve cart data from the session
        // $data['cartItems'] = $this->cart->contents();

        // Pass products data to the view
		// $this->load->view('checkout', $data);
        $data['custData_value'] = $custData;
		$this->data['custData'] = $data['custData_value'];

		$data['cartItems_value'] = $this->cart->contents();
		$this->data['cartItems'] = $data['cartItems_value'];
		$this->render_view('checkout');

	}
	public function placeOrder($custID){
        // Insert order data
        $ordData = array(
            'customer_id' => $custID,
            'grand_total' => $this->cart->total()
        );
        $insertOrder = $this->product->insertOrder($ordData);

        if($insertOrder){
            // Retrieve cart data from the session
            $cartItems = $this->cart->contents();

            // Cart items
            $ordItemData = array();
            $i=0;
            foreach($cartItems as $item){
                $ordItemData[$i]['order_id']     = $insertOrder;
                $ordItemData[$i]['product_id']     = $item['id'];
                $ordItemData[$i]['quantity']     = $item['qty'];
                $ordItemData[$i]['sub_total']     = $item["subtotal"];
                $i++;
            }

            if(!empty($ordItemData)){
                // Insert order items
                $insertOrderItems = $this->product->insertOrderItems($ordItemData);

                if($insertOrderItems){
                    // Remove items from the cart
                    $this->cart->destroy();

                    // Return order ID
                    return $insertOrder;
                }
            }
        }
        return false;
    }

	public function orderSuccess($ordID){
        // Fetch order data from the database
        // $data['order'] = $this->product->getOrder($ordID);

        // // Load order details view
		// $this->load->view($this->controller.'/order-success', $data);
		$data['order_value'] = $this->product->getOrder($ordID);
		$this->data['order'] = $data['order_value'];
		$this->render_view('order-succes');

    }

    public function send_cart()
	{
		$this->load->library('email');

		$config['mailtype'] = 'html';
		$this->email->initialize($config);

		$name=$this->input->post('name');
		$email=$this->input->post('email');
		$phone=$this->input->post('phone');
		$address=$this->input->post('address');
		$msg_subject=$this->input->post('msg_subject');
		$message=$this->input->post('message');

		$this->email->from($email);
		$this->email->to('pondooo5800@gmail.com');
		$this->email->cc('pondooo5800@gmail.com');

		$datese = date('d/m/Y');
		$message =
		'
		<html>

		<body style="background-color:#e2e1e0;font-family: Open Sans, sans-serif;font-size:100%;font-weight:400;line-height:1.4;color:#000;">
		  <table style="max-width:670px;margin:50px auto 10px;background-color:#fff;padding:50px;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;-webkit-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);-moz-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24); border-top: solid 10px green;">
			<thead>
			  <tr>
				<th style="text-align:left;"><img style="max-width: 150px;" src="https://www.bachanatours.in/book/img/logo.png" alt="bachana tours"></th>
				<th style="text-align:right;font-weight:400;">05th Apr, 2017</th>
			  </tr>
			</thead>
			<tbody>
			  <tr>
				<td style="height:35px;"></td>
			  </tr>
			  <tr>
				<td colspan="2" style="border: solid 1px #ddd; padding:10px 20px;">
				  <p style="font-size:14px;margin:0 0 6px 0;"><span style="font-weight:bold;display:inline-block;min-width:150px">Order status</span><b style="color:green;font-weight:normal;margin:0">Success</b></p>
				  <p style="font-size:14px;margin:0 0 6px 0;"><span style="font-weight:bold;display:inline-block;min-width:146px">Transaction ID</span> abcd1234567890</p>
				  <p style="font-size:14px;margin:0 0 0 0;"><span style="font-weight:bold;display:inline-block;min-width:146px">Order amount</span> Rs. 6000.00</p>
				</td>
			  </tr>
			  <tr>
				<td style="height:35px;"></td>
			  </tr>
			  <tr>
				<td style="width:50%;padding:20px;vertical-align:top">
				  <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px">Name</span> Palash Basak</p>
				  <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px;">Email</span> palash@gmail.com</p>
				  <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px;">Phone</span> +91-1234567890</p>
				  <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px;">ID No.</span> 2556-1259-9842</p>
				</td>
				<td style="width:50%;padding:20px;vertical-align:top">
				  <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px;">Address</span> Khudiram Pally, Malbazar, West Bengal, India, 735221</p>
				  <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px;">Number of gusets</span> 2</p>
				  <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px;">Duration of your vacation</span> 25/04/2017 to 28/04/2017 (3 Days)</p>
				</td>
			  </tr>
			  <tr>
				<td colspan="2" style="font-size:20px;padding:30px 15px 0 15px;">Items</td>
			  </tr>
			  <tr>
				<td colspan="2" style="padding:15px;">
				  <p style="font-size:14px;margin:0;padding:10px;border:solid 1px #ddd;font-weight:bold;">
					<span style="display:block;font-size:13px;font-weight:normal;">Homestay with fooding & lodging</span> Rs. 3500 <b style="font-size:12px;font-weight:300;"> /person/day</b>
				  </p>
				  <p style="font-size:14px;margin:0;padding:10px;border:solid 1px #ddd;font-weight:bold;"><span style="display:block;font-size:13px;font-weight:normal;">Pickup & Drop</span> Rs. 2000 <b style="font-size:12px;font-weight:300;"> /person/day</b></p>
				  <p style="font-size:14px;margin:0;padding:10px;border:solid 1px #ddd;font-weight:bold;"><span style="display:block;font-size:13px;font-weight:normal;">Local site seeing with guide</span> Rs. 800 <b style="font-size:12px;font-weight:300;"> /person/day</b></p>
				  <p style="font-size:14px;margin:0;padding:10px;border:solid 1px #ddd;font-weight:bold;"><span style="display:block;font-size:13px;font-weight:normal;">Tea tourism with guide</span> Rs. 500 <b style="font-size:12px;font-weight:300;"> /person/day</b></p>
				  <p style="font-size:14px;margin:0;padding:10px;border:solid 1px #ddd;font-weight:bold;"><span style="display:block;font-size:13px;font-weight:normal;">River side camping with guide</span> Rs. 1500 <b style="font-size:12px;font-weight:300;"> /person/day</b></p>
				  <p style="font-size:14px;margin:0;padding:10px;border:solid 1px #ddd;font-weight:bold;"><span style="display:block;font-size:13px;font-weight:normal;">Trackking and hiking with guide</span> Rs. 1000 <b style="font-size:12px;font-weight:300;"> /person/day</b></p>
				</td>
			  </tr>
			</tbody>
			<tfooter>
			  <tr>
				<td colspan="2" style="font-size:14px;padding:50px 15px 0 15px;">
				  <strong style="display:block;margin:0 0 10px 0;">Regards</strong> Bachana Tours<br> Gorubathan, Pin/Zip - 735221, Darjeeling, West bengal, India<br><br>
				  <b>Phone:</b> 03552-222011<br>
				  <b>Email:</b> contact@bachanatours.in
				</td>
			  </tr>
			</tfooter>
		  </table>
		</body>

		</html>		';

		$this->email->subject($msg_subject);
		$this->email->message($message);
		if($this->email->send()){
			echo "<script>alert('Message Success');</script>";
			redirect('refresh');
		}else{
			echo "<script>alert('Message Failed');</script>";
			redirect('refresh');
		}
	}


}
/*---------------------------- END Controller Class --------------------------------*/
