<?php
namespace Wfe\Widgets;

use Wfe\Base\BaseController;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Modal extends BaseController {
	public function widgets_register(){
		if ( ! $this->activated( 'modal' ) ) {
			return;
		}
		require_once $this->plugin_path . "widgets/modal.php";
	}
}