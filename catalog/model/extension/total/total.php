<?php
class ModelExtensionTotalTotal extends Model {
	public function getTotal($total) {
		$this->load->language('extension/total/total');

		if (isset($this->session->data['payment_method']['code']) && $this->session->data['payment_method']['code'] == 'pix') {

			$value = $total['total'];
			$percentage = $this->config->get('payment_pix_total') / 100;
			$calc = $value * $percentage;
			$total_calc = strval($total['total'] - $calc);
			$total['total'] = $total_calc;

		}

		$total['totals'][] = array(
			'code'       => 'total',
			'title'      => $this->language->get('text_total'),
			'value'      => max(0, $total['total']),
			'sort_order' => $this->config->get('total_total_sort_order')
		);
	}
}
