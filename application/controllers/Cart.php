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
		// chkMemberPerm();
		// Load cart library
		$this->load->model('common_model');
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
		$member_id = $this->session->userdata('member_id');

		$data['cart_value'] = $this->common_model->custom_query("
        SELECT *, (qty * price) as subtotal
        FROM `product_cats`
        WHERE member_id = $member_id
        GROUP BY product_id, name, price, qty
    ");
		$data['total'] = $this->common_model->custom_query("
        SELECT SUM(qty * price) as total
        FROM `product_cats`
        WHERE member_id = $member_id
    ");

		$total_price = isset($data['total'][0]['total']) ? $data['total'][0]['total'] : 0;
		$this->data['cartItems'] = $data['cart_value'];
		$this->data['cartTotals'] = $total_price;
		$this->render_view('cart');  }

	public function updateItemQty()
	{
		// Get cart item info
		$rowid = $this->input->get('rowid');
		$qty = $this->input->get('qty');

		// Initialize response
		$response = 'err';

		// Update item quantity in the database
		if (!empty($rowid) && !empty($qty)) {
			$this->load->model('common_model');
			$data = array(
				'qty' => $qty
			);
			$this->db->where('id', $rowid);
			$update = $this->db->update('product_cats', $data);

			// Check if update was successful
			if ($update) {
				$response = 'ok';
			}
		}

		// Return response
		echo $response;
	}


  public function removeItem($rowid)
  {
		$this->db->where('id', $rowid);
		$remove = $this->db->delete('product_cats');
    redirect('cart');
  }
  public function checkout()
  {
    $post = $this->input->post(NULL, TRUE);
    $custData = $data = array();
    // If order request is submitted
    $custData = array(
      'name'     => $this->session->userdata('member_fname') . ' ' . $this->session->userdata('member_lname'),
      'email'     => $this->session->userdata('member_email_addr'),
      'phone'     => $this->session->userdata('member_mobile_no'),
      'address' => $post['member_addr'],
      'member_id' => $this->session->userdata('member_id')
    );
    $insert = $this->product->insertCustomer($custData);

    if ($insert) {
      $order = $this->placeOrder($insert);
      if ($order) {
        $this->order_sendMail($order);
        redirect($this->controller . '/orderSuccess/' . $order);
      } else {
        $data['error_msg'] = 'Order submission failed, please try again.';
      }
    } else {
      $data['error_msg'] = 'Some problems occured, please try again.';
    }
    $this->render_view('cart');
  }
  public function placeOrder($custID)
  {
		$member_id = $this->session->userdata('member_id');
		$data['cart_value'] = $this->common_model->custom_query("
        SELECT *, (qty * price) as subtotal
        FROM `product_cats`
        WHERE member_id = $member_id
        GROUP BY product_id, name, price, qty
    ");
		$data['total'] = $this->common_model->custom_query("
        SELECT SUM(qty * price) as total
        FROM `product_cats`
        WHERE member_id = $member_id
    ");

		$total_price = isset($data['total'][0]['total']) ? $data['total'][0]['total'] : 0;

    // Insert order data
    $ordData = array(
      'customer_id' => $custID,
      'grand_total' => $total_price,
      'member_id' => $member_id
    );
    $insertOrder = $this->product->insertOrder($ordData);

    if ($insertOrder) {
      // Retrieve cart data from the session

      $cartItems = $data['cart_value'];

      // Cart items
      $ordItemData = array();
      $i = 0;
      foreach ($cartItems as $item) {
        $ordItemData[$i]['order_id']     = $insertOrder;
        $ordItemData[$i]['product_id']     = $item['product_id'];
        $ordItemData[$i]['quantity']     = $item['qty'];
        $ordItemData[$i]['sub_total']     = ($item['qty'] * $item["price"]);
        $i++;
      }

      if (!empty($ordItemData)) {
        // Insert order items
        $insertOrderItems = $this->product->insertOrderItems($ordItemData);

        if ($insertOrderItems) {
					// Remove items from the cart
					foreach ($cartItems as $item) {
						$this->db->where('id', $item['id']);
						$this->db->delete('product_cats');
					}
          // Return order ID
          return $insertOrder;
        }
      }
    }
    return false;
  }
  public function viewOrder()
  {
  //   echo("TET");
  //   	// 	$mpdf = new \Mpdf\Mpdf();
	// // 	$mpdf->WriteHTML('<h1>Hello world!</h1>');
	// // 	$mpdf->Output();

    // $this->load->view('order_pdfView');
    phpinfo();
  }
  public function orderSuccess($ordID)
  {
    $data['order_value'] = $this->product->getOrder($ordID);
    $this->data['order'] = $data['order_value'];
    $this->render_view('order-succes');
  }
  /**
   * สร้าง mPDF ของใบสั่งซื้อ พร้อมฟอนต์ไทยและตั้ง resource limit
   * ให้รองรับ order ที่มีรายการสินค้าจำนวนมาก (หลักพันแถว)
   * ใช้ร่วมกันทั้งหน้าดาวน์โหลด PDF และการแนบไฟล์ส่งอีเมล
   */
  private function buildOrderPDF($ordID)
  {
    // ใบสั่งซื้อที่มีรายการจำนวนมากทำให้ mPDF ใช้ memory/เวลามาก และ HTML ยาวเกิน
    // pcre.backtrack_limit เดิม (1,000,000) -> เพิ่ม limit เพื่อกัน HTTP 500
    @ini_set('memory_limit', '1024M');
    @ini_set('pcre.backtrack_limit', '50000000');
    @set_time_limit(300);

    $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
    $fontDirs = $defaultConfig['fontDir'];

    $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
    $fontData = $defaultFontConfig['fontdata'];

    $mpdf = new \Mpdf\Mpdf([
      'fontDir' => array_merge($fontDirs, [
        __DIR__ . '/tmp',
      ]),
      'fontdata' => $fontData + [
        'sarabun' => [
          'R' => 'THSarabunNew.ttf',
          'I' => 'THSarabunNew Italic.ttf',
          'B' => 'THSarabunNew Bold.ttf',
          'BI' => 'THSarabunNew BoldItalic.ttf',
        ]
      ],
      'default_font' => 'sarabun',
      'packTableData' => true, // ลด peak memory สำหรับตารางรายการสินค้าขนาดใหญ่
    ]);
    $mpdf->curlAllowUnsafeSslRequests = true;

    $order['order'] = $this->product->getOrder_PDF($ordID);
    $order['order_product'] = $this->product->getOrderProduct_PDF($ordID);
    $html = $this->load->view('order_pdfView', array(
      'order'  =>  $order['order'],
      'order_product'  =>  $order['order_product']
    ), true);
    $mpdf->WriteHTML($html);
    $mpdf->AddPage();
    $html_img = $this->load->view('order_img_pdfView', [], true);
    $mpdf->WriteHTML($html_img);

    return $mpdf;
  }

  /**
   * โฟลเดอร์เก็บ cache ไฟล์ PDF ของใบสั่งซื้อ (ถูก gitignore อยู่แล้ว)
   */
  private function orderPdfCacheDir()
  {
    $dir = APPPATH . 'cache/order_pdf/';
    if (!is_dir($dir)) {
      @mkdir($dir, 0775, true);
    }
    return $dir;
  }

  /**
   * คืนเนื้อหา PDF ของใบสั่งซื้อ (binary string) โดยใช้ cache บนดิสก์
   * ใบสั่งซื้อไม่เปลี่ยนหลังสั่งซื้อ จึง render ด้วย mPDF ครั้งเดียวแล้วใช้ซ้ำได้
   * ครั้งถัดไปจึงโหลดทันที ใช้ร่วมกันทั้งหน้าดาวน์โหลดและการส่งอีเมล
   * (ลบไฟล์ใน application/cache/order_pdf/ เพื่อบังคับสร้างใหม่)
   */
  private function getOrderPdfContent($ordID)
  {
    $cacheFile = $this->orderPdfCacheDir() . 'order_' . (int) $ordID . '.pdf';
    if (is_file($cacheFile) && filesize($cacheFile) > 0) {
      return file_get_contents($cacheFile); // cache hit: ข้ามการ render ของ mPDF
    }
    $mpdf = $this->buildOrderPDF($ordID);
    $content = $mpdf->Output('', 'S');
    @file_put_contents($cacheFile, $content, LOCK_EX);
    return $content;
  }

  public function orderPDF($ordID)
  {
    $content = $this->getOrderPdfContent($ordID);
    $file_name = 'ใบสั่งซื้อสินค้า.pdf';
    // เสิร์ฟ PDF แบบ inline (แสดงในเบราว์เซอร์) พร้อมรองรับชื่อไฟล์ภาษาไทย
    header('Content-Type: application/pdf');
    header("Content-Disposition: inline; filename=\"order_{$ordID}.pdf\"; filename*=UTF-8''" . rawurlencode($file_name));
    header('Content-Length: ' . strlen($content));
    echo $content;
  }
  public function order_sendMail($ordID)
  {
    $post = $this->input->post(NULL, TRUE);
    // print_r($post);
    // echo"<br>";
    // print_r($ordID);
    // die();

    if (@$post['member_email_order'] != '') {
      $to = @$post['member_email_order'];
      $content = $this->getOrderPdfContent($ordID);
      $filename = "order.pdf";
      $fromMail = "admin@yeejub.net";
      $fromName = "YeeJub | Order";
      $mailTo = $to;

      $this->load->library('email');
      $this->email->set_mailtype("html");
      $this->email->set_newline("\r\n");
      $this->email->from($fromMail, $fromName);
      $this->email->to($mailTo);
          $this->email->subject("#คำสั่งซื้อหมายเลข  ".$ordID);
      $this->email->attach($content, 'attachment', $filename, 'application/pdf');
      if($this->email->send()){
        $this->session->set_flashdata('message', 'ใบสั่งซื้อสินค้าของคุณถูกส่งไปยัง Email เรียบร้อยแล้ว โปรดตรวจสอบ');
        redirect($this->controller . '/orderSuccess/' . $ordID);
      }else{
        $this->session->set_flashdata('message', 'ส่ง Email ไม่สำเร็จ');
        redirect($this->controller . '/orderSuccess/' . $ordID);
      }
    } else {
      $content = $this->getOrderPdfContent($ordID);
      $filename = "order.pdf";
      $fromMail = "admin@yeejub.net";
      $fromName = "YeeJub | Order";
      $mailTo = "yeejub20@gmail.com";

      $this->load->library('email');
      $this->email->set_mailtype("html");
      $this->email->set_newline("\r\n");
      $this->email->from($fromMail, $fromName);
      $this->email->to($mailTo);
      $this->email->subject("#คำสั่งซื้อหมายเลข  ".$ordID);
      $this->email->attach($content, 'attachment', $filename, 'application/pdf');
      $this->email->send();
    }
  }

}
/*---------------------------- END Controller Class --------------------------------*/
