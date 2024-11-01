<?php
namespace Elementor;

function codecans_elementor_init() {
	Plugin::instance()->elements_manager->add_category( 'wfe-ccn', [
		'title' => 'Widgets For Elementor',
		'icon'  => 'font',
	], 1 );
}

add_action( 'elementor/init', 'Elementor\codecans_elementor_init' );

