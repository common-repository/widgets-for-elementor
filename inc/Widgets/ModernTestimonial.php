<?php
namespace Wfe\Widgets;

use Wfe\Base\BaseController;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class ModernTestimonial extends BaseController {
	public function widgets_register(){
		if ( ! $this->activated( 'moderntestimonial' ) ) {
			return;
		}
		require_once $this->plugin_path . "widgets/moderntestimonial.php";
	}
}