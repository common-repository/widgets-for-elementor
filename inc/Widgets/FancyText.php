<?php
namespace Wfe\Widgets;

use Wfe\Base\BaseController;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class FancyText extends BaseController {

	public function widgets_register(){
		if ( ! $this->activated( 'fancytext' ) ) {
			return;
		}
		require_once $this->plugin_path . "widgets/fancytext.php";
	}

}