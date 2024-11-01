<?php
namespace Wfe\Widgets;

use Wfe\Base\BaseController;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class SplitText extends BaseController {
	public function widgets_register(){
		if ( ! $this->activated( 'splittext' ) ) {
			return;
		}
		require_once $this->plugin_path . "widgets/splittext.php";
	}
}