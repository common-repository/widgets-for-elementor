<?php
/**
 * @package  WfeElementor
 */
namespace Wfe;

final class Widgets {
	/**
	 * Store all the classes inside an array
	 *
	 * @return array Full list of classes
	 */
	public static function get_services() {
		return [
			Widgets\Heading::class,
			Widgets\Infobox::class,
			Widgets\Services::class,
			Widgets\TextSeparator::class,
			Widgets\SplitText::class,
			Widgets\FlipBox::class,
			Widgets\FancyText::class,
			Widgets\Banner::class,
			Widgets\PricingTable::class,
			Widgets\Modal::class,
			Widgets\ShapeDivider::class,
			Widgets\TwitterFeed::class,
			Widgets\ToolTip::class,
			Widgets\DataTable::class,
			Widgets\VubonHover::class,
			Widgets\UltimateButton::class,
			Widgets\TeamShowcase::class,
			Widgets\ListProduct::class,
			Widgets\Testimonial::class,
			Widgets\ModernTestimonial::class,
			Widgets\CallToAction::class,
			Widgets\ImageComparison::class,
			Widgets\ImageHotspot::class,
			Widgets\PreLoader::class,
		];

	}

	/**
	 * Loop through the classes::class, initialize them::class,
	 * and call the register() method if it exists
	 *
	 * @return
	 */
	public static function register_services() {
		foreach ( self::get_services() as $class ) {
			$widgets = self::instantiate( $class );
			if ( method_exists( $widgets, 'widgets_register' ) ) {
				$widgets->widgets_register();
			}
		}
	}

	/**
	 * Initialize the class
	 *
	 * @param  class $class class from the services array
	 *
	 * @return class instance  new instance of the class
	 */
	private static function instantiate( $class ) {
		$widgets = new $class();

		return $widgets;
	}

}