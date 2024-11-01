<?php
namespace Wfe\Widgets;

use Wfe\Base\BaseController;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class VubonHover extends BaseController {
	public function widgets_register(){
		if ( ! $this->activated( 'vubonhovereffects' ) ) {
			return;
		}
		require_once $this->plugin_path . "widgets/vubonhovereffects.php";
	}
}