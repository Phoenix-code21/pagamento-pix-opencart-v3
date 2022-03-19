<?php
class ControllerExtensionPaymentPix extends Controller {
	public function index() {
		return $this->load->view('extension/payment/pix');
	}

	public function confirm() {
		$json = array();

		if (isset($this->session->data['payment_method']['code']) && $this->session->data['payment_method']['code'] == 'pix') {
		
			$this->load->model('checkout/pix_order');

			$this->model_checkout_pix_order->addOrderHistory($this->session->data['order_id'], $this->config->get('payment_pix_order_status_id'));

			$json['redirect'] = $this->url->link('checkout/pix_success');
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}
