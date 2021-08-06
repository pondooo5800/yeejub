<?php
if (!defined('BASEPATH'))  exit('No direct script access allowed');

/**
 * [ Controller File name : Cart.php ]
 */
class Cart extends CI_Controller
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

        // Load cart library
        $this->load->library('cart');
		$this->load->model('product_model', 'product');

		$data['base_url'] = base_url();
		$data['site_url'] = site_url();

		$data['csrf_token_name'] = $this->security->get_csrf_token_name();
		$data['csrf_cookie_name'] = $this->config->item('csrf_cookie_name');
		$data['csrf_protection_field'] = insert_csrf_field(true);

		$this->per_page = 12;
		$this->num_links = 6;
		$this->uri_segment = 3;

		$this->data = $data;
		$this->breadcrumb_data = $data;
		$this->left_sidebar_data = $data;
		$this->controller = 'cart';

	}

	// ------------------------------------------------------------------------

	/**
	 * Render this controller page
	 * @param String path of controller
	 * @param Integer total record
	 */
	private function render_view($path)
	{
		$this->data['page_header'] = $this->parser->parse('template/frontend/headerView', $this->data, TRUE);
		$this->data['page_content'] = $this->parser->parse_repeat($path, $this->data, TRUE);
		$this->data['page_footer'] = $this->parser->parse('template/frontend/footerView', $this->data, TRUE);
		$this->data['another_css'] = $this->another_css;
		$this->data['another_js'] = $this->another_js;
		$this->parser->parse('template/frontend/indexView', $this->data);
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
		$data['cart_value'] = $this->cart->contents();
		$this->data['cartItems'] = $data['cart_value'];
		$this->render_view('cart');
	}

	public function updateItemQty(){
        $update = 0;

        // Get cart item info
        $rowid = $this->input->get('rowid');
        $qty = $this->input->get('qty');

        // Update item in the cart
        if(!empty($rowid) && !empty($qty)){
            $data = array(
                'rowid' => $rowid,
                'qty'   => $qty
            );
            $update = $this->cart->update($data);
        }

        // Return response
        echo $update?'ok':'err';
	}

	public function removeItem($rowid)
	{
		$remove = $this->cart->remove($rowid);
        redirect('cart');
	}
	public function checkout()
	{
        $custData = $data = array();
        // If order request is submitted
            $custData = array(
                'name'     => $this->session->userdata('member_fname') .' '. $this->session->userdata('member_lname'),
                'email'     => $this->session->userdata('member_email_addr'),
                'phone'     => $this->session->userdata('member_mobile_no'),
                'address'=> $this->session->userdata('member_email_addr')
            );
                $insert = $this->product->insertCustomer($custData);

                if($insert){
					$order = $this->placeOrder($insert);
                    $query = $this->db->query('SELECT order_items.*, products.* FROM order_items LEFT JOIN products ON order_items.product_id = products.product_id WHERE order_items.order_id ='.$order.'');
                    $sub_total = $query->result_array();

                    $this->load->library('email');

                    $config['mailtype'] = 'html';
                    $this->email->initialize($config);

                    $name=$this->input->post('name');
                    $email=$this->input->post('email');
                    $phone=$this->input->post('phone');
                    $address=$this->input->post('address');

                    $this->email->from($email);
                    // $this->email->to('info@ocean-bluewave.com');
                    $this->email->to('pondooo5800@gmail.com');
                    // $this->email->cc('pondooo5800@gmail.com');
                    // $list = array('Ta.alava@gmail.com', 'Nattanida@icon-rich.com', 'sales@ocean-bluewave.com','mgmt@ocean-bluewave.com');
                    // $this->email->cc($list);
                    $datese = date('d/m/Y');
					$message =
                    '
                    <html>

                    <body style="background-color:#e2e1e0;font-family: Open Sans, sans-serif;font-size:100%;font-weight:400;line-height:1.4;color:#000;">
                      <table style="max-width:670px;margin:50px auto 10px;background-color:#fff;padding:50px;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;-webkit-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);-moz-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24); border-top: solid 10px;">
                        <thead>
                          <tr>
                            <th style="text-align:left;">Order :'.$order.'</th>
                            <th style="text-align:right;font-weight:400;">'.$datese.'</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td style="height:35px;"></td>
                          </tr>
                          <tr>
                            <td style="width:50%;padding:20px;vertical-align:top">
                              <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px">Name</span> '.$name.'</p>
                              <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px;">Email</span> '.$email.'</p>
                              <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px;">Phone</span> '.$phone.'</p>
                            </td>
                            <td style="width:50%;padding:20px;vertical-align:top">
                              <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px;">Address</span>'.$address.'</p>
                            </td>
                          </tr>
                          <tr>
                            <td colspan="2" style="font-size:20px;padding:30px 15px 0 15px;">Items</td>
                          </tr>
                          <tr>
                            <td colspan="2" style="padding:15px;">';
                            foreach($sub_total as $item) {
                                $message .='
                              <p style="font-size:14px;margin:0;padding:10px;border:solid 1px #ddd;font-weight:bold;">
                                <span style="display:block;font-size:13px;font-weight:normal;">'.$item['product_name_th'].'</span> Price.'.$item['price'].'<b style="font-size:12px;font-weight:300;"> ฿ ('.$item['quantity'].') Size ('.$item['size'].')</b>
                              </p>
                              <p style="font-size:14px;margin:0;padding:10px;border:solid 1px #ddd;font-weight:bold;"><span style="display:block;font-size:13px;font-weight:normal;">Total</span> Price. '.$item['sub_total'].' <b style="font-size:12px;font-weight:300;">฿</b></p>
';
                             }
                            $message .= '
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </body>

                    </html>		';

                    $this->email->subject('Order Product');
                    $this->email->message($message);
                    $this->email->send();                    // If the order submission is successful
                    if($order){
                        redirect($this->controller.'/orderSuccess/'.$order);
                    }else{
                        $data['error_msg'] = 'Order submission failed, please try again.';
                    }
                }else{
                    $data['error_msg'] = 'Some problems occured, please try again.';
                }
		$this->render_view('cart');
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
		$data['order_value'] = $this->product->getOrder($ordID);
		$this->data['order'] = $data['order_value'];
		$this->render_view('order-succes');
    }


}
/*---------------------------- END Controller Class --------------------------------*/
