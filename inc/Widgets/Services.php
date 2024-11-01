<?php
namespace Wfe\Widgets;

use Wfe\Base\BaseController;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Services extends BaseController {
	public function widgets_register(){
		if ( ! $this->activated( 'services' ) ) {
			return;
		}
		require_once $this->plugin_path . "widgets/services.php";
	}
}