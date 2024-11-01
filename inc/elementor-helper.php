<?php
namespace Elementor;

function codecans_elementor_init(){
    Plugin::instance()->elements_manager->add_category(
        'wts-eae',
        [
            'title'  => 'CodeCans Addon Elements',
            'icon' => 'font'
        ],
        1
    );
}
add_action('elementor/init','Elementor\codecans_elementor_init');



