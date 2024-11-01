<?php
namespace Wfe\Widgets;

use Wfe\Base\BaseController;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class CallToAction extends BaseController {
	public function widgets_register(){
		if ( ! $this->activated( 'calltoaction' ) ) {
			return;
		}
		require_once $this->plugin_path . "widgets/calltoaction.php";
	}
}