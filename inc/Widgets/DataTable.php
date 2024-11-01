<?php
namespace Wfe\Widgets;

use Wfe\Base\BaseController;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class DataTable extends BaseController {
	public function widgets_register(){
		if ( ! $this->activated( 'datatable' ) ) {
			return;
		}
		require_once $this->plugin_path . "widgets/datatable.php";
	}
}