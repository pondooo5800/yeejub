<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * File Uploading Class Extension
 *
 * @package     CodeIgniter
 * @subpackage  Libraries
 * @category    Uploads
 * @author      Harrison Emmanuel (Eharry.me)
 * @link        https://www.eharry.me/blog/post/my-codeigniter-upload-extension/
 */
class Langlib{

    private $CI;
    public function __construct()
    {
        $this->CI =& get_instance(); // ประกาศแปรแบบ Sigleton ทำให้เราสามารถเข้าถึงคลาสต่าง ๆ ได้ใน lib นี้
    }
    public function init_default_language() // ฟังก์ชั่นสำหรับตรวจสอบภาษาปัจจุบันที่เลือก
    {
        if($this->CI->session->userdata('lang')==NULL){ // ถ้าไม่มี session อยู่ให้ค่าเริ่มต้นเป็นภาษาไทย
            $lang = 'thailand';
            $this->CI->session->set_userdata('lang',$lang);
        }else{
            $lang = $this->CI->session->userdata('lang');
        }
        if($lang == "thailand"){
            $this->CI->PAGE['suffix'] = "th"; // ประกาศตัวแปร suffix มีค่าตามภาษานั้น ๆ
        }else{
            $this->CI->PAGE['suffix'] = "en";
        }

    }
    public function chooseLang($lang) // ใช้สำหรับเปลี่ยนภาษา เปลี่ยนค่าตัวแปร session และ refresh หน้า
    {
        $this->CI->session->set_userdata('lang',$lang);
        redirect($this->CI->router->class,'refresh');
    }
}