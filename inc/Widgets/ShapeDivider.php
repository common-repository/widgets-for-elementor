<?php
namespace Wfe\Widgets;

use Wfe\Base\BaseController;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class ShapeDivider extends BaseController {
	public function widgets_register(){
		if ( ! $this->activated( 'shapedivider' ) ) {
			return;
		}
		require_once $this->plugin_path . "widgets/shapedivider.php";
	}
}