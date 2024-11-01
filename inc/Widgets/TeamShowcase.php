<?php
namespace Wfe\Widgets;

use Wfe\Base\BaseController;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class TeamShowcase extends BaseController {
	public function widgets_register(){
		if ( ! $this->activated( 'teamshowcase' ) ) {
			return;
		}
		require_once $this->plugin_path . "widgets/teamshowcase.php";
	}
}