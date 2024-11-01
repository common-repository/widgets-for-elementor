<?php
namespace Wfe\Widgets;

use Wfe\Base\BaseController;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class PricingTable extends BaseController {
    public function widgets_register(){
	    if ( ! $this->activated( 'pricing' ) ) {
		    return;
	    }
	    require_once $this->plugin_path . "widgets/pricingtable.php";
    }
}

