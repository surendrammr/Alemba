<?php namespace Alemba\Alemba\Models;

use Model;

class FormExport extends \Backend\Models\ExportModel
{
	public function exportData($columns, $sessionKey = null)
	{
		$orders = Form::all();
		$orders->each(function($order) use ($columns) {
			$order->addVisible($columns);
		});
		return $orders->toArray();
	}
}

?>