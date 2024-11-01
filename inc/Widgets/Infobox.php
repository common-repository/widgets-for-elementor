<?php
namespace Wfe\Widgets;

use Wfe\Base\BaseController;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Infobox extends BaseController {
	public function widgets_register(){
		if ( ! $this->activated( 'infobox' ) ) {
			return;
		}
		require_once $this->plugin_path . "widgets/infobox.php";
	}
}