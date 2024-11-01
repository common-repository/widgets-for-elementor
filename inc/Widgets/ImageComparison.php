<?php
namespace Wfe\Widgets;

use Wfe\Base\BaseController;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class ImageComparison extends BaseController {
	public function widgets_register(){
		if ( ! $this->activated( 'imagecomparison' ) ) {
			return;
		}
		require_once $this->plugin_path . "widgets/imagecomparison.php";
	}
}