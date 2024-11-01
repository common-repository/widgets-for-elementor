<?php
namespace Wfe\Widgets;

use Wfe\Base\BaseController;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Banner extends BaseController {
	public function widgets_register(){
		if ( ! $this->activated( 'banner' ) ) {
			return;
		}
		require_once $this->plugin_path . "widgets/wfe-banner.php";
	}
}