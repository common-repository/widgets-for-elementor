<?php
namespace Wfe\Widgets;

use Wfe\Base\BaseController;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Heading extends BaseController {
	public function widgets_register(){
		if ( ! $this->activated( 'heading' ) ) {
			return;
		}
		require_once $this->plugin_path . "widgets/heading.php";
	}
}