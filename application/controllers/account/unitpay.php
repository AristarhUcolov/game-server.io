<?php
/*
Copyright (c) 2014 LiteDevel

Данная лицензия разрешает лицам, получившим копию данного программного обеспечения
и сопутствующей документации (в дальнейшем именуемыми «Программное Обеспечение»),
безвозмездно использовать Программное Обеспечение в  личных целях, включая неограниченное
право на использование, копирование, изменение, добавление, публикацию, распространение,
также как и лицам, которым запрещенно использовать Програмное Обеспечение в коммерческих целях,
предоставляется данное Программное Обеспечение,при соблюдении следующих условий:

Developed by LiteDevel
*/
class unitpayController extends Controller {

	public function index() {
		
		$this->document->setActiveSection('account');
		$this->document->setActiveItem('unitpay');
		
		if(!$this->user->isLogged()) {
			$this->session->data['error'] = "Вы не авторизированы!";
			$this->response->redirect($this->config->url . 'account/login');
		}
		if($this->user->getAccessLevel() < 0) {
			$this->session->data['error'] = "У вас нет доступа к данному разделу!";
			$this->response->redirect($this->config->url);
		}
		
		$this->getChild(array('common/header', 'common/footer'));
		return $this->load->view('account/unitpay', $this->data);
	}
	
	public function ajax() {
		if(!$this->user->isLogged()) {  
	  		$this->data['status'] = "error";
			$this->data['error'] = "Вы не авторизированы!";
			return json_encode($this->data);
		}
		if($this->user->getAccessLevel() < 1) {
	  		$this->data['status'] = "error";
			$this->data['error'] = "У вас нет доступа к данному разделу!";
			return json_encode($this->data);
		}
		
		$this->load->model('invoices');
		
		if($this->request->server['REQUEST_METHOD'] == 'POST') {
			$errorPOST = $this->validatePOST();
			if(!$errorPOST) {
				$ammount = @$this->request->post['ammount'];
				
				$server = $this->config->rk_server;
				$login = $this->config->rk_login;
				$password1 = $this->config->rk_password1;
				
				$userid = $this->user->getId();
				
				$invoiceData = array(
					'user_id'			=> $userid,
					'invoice_ammount'	=> $ammount,
					'invoice_status'	=> 0
				);
				$invid = $this->invoicesModel->createInvoice($invoiceData);
				
				$server = $this->config->unitpay_url;
				$url = "$server";
				/* Параметры: */
				$url .= "?sum=$ammount";
				$url .= "&account=$invid";
				$url .= "&desc=Пополнение баланса аккаунта (ID " . $userid . ")";
				
				$this->data['status'] = "success";
				$this->data['url'] = $url;
			} else {
				$this->data['status'] = "error";
				$this->data['error'] = $errorPOST;
			}
		}

		return json_encode($this->data);
	}
	
	private function validatePOST() {
		$this->load->library('validate');
		
		$validateLib = new validateLibrary();
		
		$result = null;
		
		$ammount = @$this->request->post['ammount'];
		if(!$validateLib->money($ammount)) {
			$result = "Укажите сумму пополнения в допустимом формате!";
		}
		elseif(10 > $ammount || $ammount > 5000) {
			$result = "Укажите сумму от 10 до 5000 рублей!";
		}
		return $result;
	}
}
?>
