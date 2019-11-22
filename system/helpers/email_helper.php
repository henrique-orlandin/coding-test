<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter Email Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/helpers/email_helper.html
 */

// ------------------------------------------------------------------------

/**
 * Validate email address
 *
 * @access	public
 * @return	bool
 */
if ( ! function_exists('valid_email'))
{
	function valid_email($address)
	{
		return ( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $address)) ? FALSE : TRUE;
	}
}

// ------------------------------------------------------------------------

/**
 * Send an email
 *
 * @access	public
 * @return	bool
 */
if ( ! function_exists('send_email'))
{
	function send_email($recipient, $subject = 'Test email', $message = 'Hello World')
	{
		return mail($recipient, $subject, $message);
	}
}

if ( ! function_exists('sendEmailCms'))
{
	function sendEmailCms ($subject, $infos, $to = false){
		$instanceName =& get_instance();
		$config = $instanceName->config->item('config_email');
		$instanceName->load->helper('file');
		$instanceName->load->library('email', $config);

		$instanceName->email->set_newline("\r\n");
		$instanceName->email->from($config['smtp_user']);
		$instanceName->email->to($to ? $to : $instanceName->config->item('trinitas_email'));

		$instanceName->email->subject($subject);

		$message['base_url'] = base_url().'application/modules/cms/assets/email/';
		$message['data'] = date('d/m/Y -  H:i:s');
		$message['title'] = $subject;

		$message['body'] = "";
		foreach ($infos as $key => $info) {
			$message['body'] .= "<strong>".$key.":</strong> ".$info."<br/><br/>";
		}

		$bodyEmail = read_file('application/modules/cms/assets/email/email.html');

		$bodyEmail = mail_replace($bodyEmail, $message);
		$instanceName->email->message($bodyEmail);
		$return = $instanceName->email->send();

		return $return;

	}
}

if ( ! function_exists('sendEmail'))
{
	function sendEmail ($subject, $infos, $to = false){
		$instanceName =& get_instance();
		$config = $instanceName->config->item('config_email');
		$instanceName->load->helper('file');
		$instanceName->load->library('email', $config);

		$instanceName->email->set_newline("\r\n");
		$instanceName->email->from($config['smtp_user'], $config['name']);
		$instanceName->email->to($to ? $to : $instanceName->config->item('trinitas_email'));

		$instanceName->email->subject($subject);

		$message['base_url'] = base_url().'application/modules/comum/assets/email/';
		$message['data'] = date('d/m/Y -  H:i:s');
		$message['title'] = $subject;

		$message['body'] = "";
		foreach ($infos as $key => $info) {
			$message['body'] .= "<strong>".$key.":</strong> ".$info."<br/><br/>";
		}

        $bodyEmail = read_file('application/modules/comum/assets/email/email.html');

        $bodyEmail = mail_replace($bodyEmail, $message);
		$instanceName->email->message($bodyEmail);
		$instanceName->email->send();

	}
}


/* End of file email_helper.php */
/* Location: ./system/helpers/email_helper.php */