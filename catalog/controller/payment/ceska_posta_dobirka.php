<?php

/**
 * @property \ModelCheckoutOrder $model_checkout_order
 */
class ControllerPaymentCeskaPostaDobirka extends Controller
{

	protected function index()
	{
		$this->data['button_confirm'] = $this->language->get('button_confirm');
		$this->data['button_back'] = $this->language->get('button_back');

		$this->data['continue'] = HTTPS_SERVER . 'index.php?route=checkout/success';

		if ($this->request->get['route'] != 'checkout/guest_step_3') {
			$this->data['back'] = HTTPS_SERVER . 'index.php?route=checkout/payment';
		} else {
			$this->data['back'] = HTTPS_SERVER . 'index.php?route=checkout/guest_step_2';
		}

		$this->id = 'payment';

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/ceska_posta_dobirka.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/payment/ceska_posta_dobirka.tpl';
		} else {
			$this->template = 'default/template/payment/ceska_posta_dobirka.tpl';
		}

		$this->render();
	}



	public function confirm()
	{
		$this->load->model('checkout/order');

		$this->model_checkout_order->confirm($this->session->data['order_id'], $this->config->get('ceska_posta_dobirka_order_status_id'));
	}
}
