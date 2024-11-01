<?php
namespace Wfe\Widgets;

use Wfe\Base\BaseController;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class TwitterFeed extends BaseController {
	public function widgets_register(){
		if ( ! $this->activated( 'twitterfeed' ) ) {
			return;
		}
		require_once $this->plugin_path . "widgets/twitterfeed.php";
	}
}