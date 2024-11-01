<?php
/**
 * @package  PrimeExtVc
 */
namespace Wfe\Base;

class Deactivate {
	public static function deactivate() {
		flush_rewrite_rules();
	}
}