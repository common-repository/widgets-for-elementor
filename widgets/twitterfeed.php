<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Wfe_twitterfeed extends Widget_Base {

	public function get_name() {
		return 'wfe-twitterfeed';
	}

	public function get_title() {
		return __( 'Twitter Feed', 'wfe_ccn' );
	}

	public function get_icon() {
		return 'fa fa-twitter wfe-ccn-pe';
	}


	public function get_categories() {
		return [ 'wfe-ccn' ];
	}

	// Adding the controls fields for the premium title
	// This will controls the animation, colors and background, dimensions etc
	protected function _register_controls() {

		$this->start_controls_section(
			'section_general',
			[
				'label' => __( 'General', 'wfe_elementor' )
			]
		);

		$this->add_control(
			'embed_type',
			[
				'label'   => __( 'Type', 'wfe_elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'handle',
				'options' => [
					//'collection' => 'Collection',
					//'tweet' => 'Tweet',
					//'profile' => 'Profile',
					//'list' => 'List',
					//'moments' => 'Moments',
					//'likes' => 'Likes ',
					'handle'  => __( 'Handle', 'wfe_elementor' ),
					'hashtag' => __( 'Hashtag', 'wfe_elementor' ),
				]
			]
		);

		$this->add_control(
			'url_collection',
			[
				'label'       => __( 'Enter URL', 'wfe_elementor' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'https://twitter.com/webtechhardik', 'wfe_elementor' ),
				'default'     => 'https://twitter.com/mseckington/timelines/',
				'condition'   => [
					'embed_type' => 'collection'
				]

			]
		);

		$this->add_control(
			'url_profile',
			[
				'label'       => __( 'Enter URL', 'wfe_elementor' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'https://twitter.com/mseckington', 'wfe_elementor' ),
				'default'     => 'https://twitter.com/mseckington',
				'condition'   => [
					'embed_type' => 'profile'
				]

			]
		);

		$this->add_control(
			'url_list',
			[
				'label'       => __( 'Enter URL', 'wfe_elementor' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'https://twitter.com/webtechhardik', 'wfe_elementor' ),
				'default'     => 'https://twitter.com/mseckington/lists/national-parks',
				'condition'   => [
					'embed_type' => 'list'
				]

			]
		);

		$this->add_control(
			'url_moments',
			[
				'label'       => __( 'Enter URL', 'wfe_elementor' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'https://twitter.com/webtechhardik', 'wfe_elementor' ),
				'default'     => 'https://twitter.com/i/moments/625792726546558977',
				'condition'   => [
					'embed_type' => 'moments'
				]

			]
		);

		$this->add_control(
			'url_likes',
			[
				'label'       => __( 'Enter URL', 'wfe_elementor' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'https://twitter.com/webtechhardik', 'wfe_elementor' ),
				'default'     => 'https://twitter.com/mseckington/likes',
				'condition'   => [
					'embed_type' => 'likes'
				]

			]
		);

		$this->add_control(
			'username',
			[
				'label'       => __( 'Enter UserName', 'wfe_elementor' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( '@username', 'wfe_elementor' ),
				'default'     => '@mseckington',
				'condition'   => [
					'embed_type' => 'handle',
				]
			]

		);


		$this->add_control(
			'hashtag',
			[
				'label'       => __( 'Enter Hashtag', 'wfe_elementor' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( '#hashtag', 'wfe_elementor' ),
				'condition'   => [
					'embed_type' => 'hashtag',
				]
			]

		);

		$this->add_control(
			'display_mode_collection',
			[
				'label'     => __( 'Display Mode', 'wfe_elementor' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'timeline',
				'options'   => [
					'timeline' => __( 'Timeline', 'wfe_elementor' ),
					'grid'     => __( 'Grid', 'wfe_elementor' ),
				],
				'condition' => [
					'embed_type' => 'collection'
				]

			]
		);

		$this->add_control(
			'no_of_tweets',
			[
				'label'     => __( 'Display No of Tweets', 'wfe_elementor' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 20,
				'min'       => '2',
				'max'       => '50',
				'step'      => '1',
				'condition' => [

					'display_mode_collection' => 'grid',
					'embed_type'              => 'collection',
				]
			]
		);

		/* $this->add_control(
			 'height',
			 [
				 'label' =>__('Height' , 'wfe_elementor'),
				 'type' =>Controls_Manager::SLIDER,
				 'default' =>[
					 'size' => 500,

				 ],
				 'range'=>[
					 'px' =>[
						 'min' =>250,
						 'max' =>1300,
						 'step' =>10
					 ]
				 ],
				 'condition' =>[
					 'embed_type!'=>'moments',
					 'display_mode_collection' => 'timeline',
					 'display_mode_profile' =>'timeline'
				 ]
			 ]
		 );



		 $this->add_control(
			 'theme',
			 [
				 'label' =>__('Theme' , 'wfe_elementor'),
				 'type' =>Controls_Manager::SELECT,
				 'default' => 'light',
				 'options' => [
					 'light' => 'Light',
					 'dark' => 'Dark'
				 ],
				 'conditions' => [
				   'relation' => 'or',
				   'terms' => [
					   [
						   'name' => 'display_mode_collection',
						   'operator' => 'in',
						   'value' => 'timeline'
					   ],
					   [
						   'name' => 'display_mode_profile',
						   'operator' => 'in',
						   'value' => 'timeline'
					   ]
				   ]
				 ]
			 ]
		 );

		 $this->add_control(
			 'link_color',
			 [
				 'label' =>__('Display Link Color' , 'wfe_elementor'),
				 'type' =>Controls_Manager::COLOR,
				 'scheme' => [
					 'type' => Scheme_Color::get_type(),
					 'value' => Scheme_Color::COLOR_1,
				 ],
				 'conditions' => [
					 'terms' => [
						 [
							 'terms' => [

								 [
									 'name' => 'embed_type',
									 'operator' => '==',
									 'value'  => 'collection'
								 ],
								 [
									 'name' => 'display_mode_collection',
									 'operator' => '==',
									 'value' => 'timeline'
								 ]
							 ]
						 ],
						 [
							 'terms' => [
								 [
									 'name' => 'embed_type',
									 'operator' => '==',
									 'value'  => 'profile'
								 ],
								 [
									 'name' => 'display_mode_profile',
									 'operator' => '==',
									 'value' => 'timeline'
								 ]
							 ]
						 ]
					 ]
				 ]
			 ]
		 );
		*/
		$this->add_control(
			'height_collection_timeline',
			[
				'label'     => __( 'Height', 'wfe_elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => 500,

				],
				'range'     => [
					'px' => [
						'min'  => 250,
						'max'  => 1300,
						'step' => 10
					]
				],
				'condition' => [

					'display_mode_collection' => 'timeline',
					'embed_type'              => 'collection',
					// 'display_mode_profile' =>'timeline'
				]
			]
		);

		$this->add_control(
			'theme_collection_timeline',
			[
				'label'     => __( 'Theme', 'wfe_elementor' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'light',
				'options'   => [
					'light' => __( 'Light', 'wfe_elementor' ),
					'dark'  => __( 'Dark', 'wfe_elementor' ),
				],
				'condition' => [
					'display_mode_collection' => 'timeline',
					'embed_type'              => 'collection',
					//'display_mode_profile' =>'timeline'
				]
			]
		);

		$this->add_control(
			'link_color_collection',
			[
				'label'     => __( 'Display Link Color', 'wfe_elementor' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'condition' => [

					'display_mode_collection' => 'timeline',
					'embed_type'              => 'collection',
					//'display_mode_profile' =>'timeline'

				]
			]
		);

		$this->add_control(
			'display_mode_profile',
			[
				'label'     => __( 'Display Mode', 'wfe_elementor' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'timeline',
				'options'   => [
					'timeline' => __( 'Timeline', 'wfe_elementor' ),
					'button'   => __( 'Button', 'wfe_elementor' ),
				],
				'condition' => [
					'embed_type' => [ 'profile', 'handle' ]
				]

			]
		);

		$this->add_control(
			'height_profile_timeline',
			[
				'label'     => __( 'Height', 'wfe_elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => 500,

				],
				'range'     => [
					'px' => [
						'min'  => 250,
						'max'  => 1300,
						'step' => 10
					]
				],
				'condition' => [

					'display_mode_profile' => 'timeline',
					'embed_type'           => [ 'profile', 'handle' ]
					//'display_mode_collection' => 'timeline',

				]
			]
		);

		$this->add_control(
			'theme_profile_timeline',
			[
				'label'     => __( 'Theme', 'wfe_elementor' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'light',
				'options'   => [
					'light' => __( 'Light', 'wfe_elementor' ),
					'dark'  => __( 'Dark', 'wfe_elementor' ),
				],
				'condition' => [
					'display_mode_profile' => 'timeline',
					'embed_type'           => [ 'profile', 'handle' ]
					//'display_mode_profile' =>'timeline'
				]
			]
		);

		$this->add_control(
			'link_color_profile',
			[
				'label'     => __( 'Display Link Color', 'wfe_elementor' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'condition' => [

					'display_mode_profile' => 'timeline',
					'embed_type'           => [ 'profile', 'handle' ]
					//'display_mode_collection' => 'timeline',


				]
			]
		);


		$this->add_control(
			'button_type',
			[
				'label'     => __( 'Button Type', 'wfe_elementor' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'follow-button',
				'options'   => [
					'follow-button'  => __( 'Follow', 'wts-aea' ),
					'mention-button' => __( 'Mention', 'wfe_elementor' ),
				],
				'condition' => [
					'display_mode_profile' => 'button',
					'embed_type'           => [ 'profile', 'handle' ]
				]
			]
		);

		$this->add_control(
			'hide_name',
			[
				'label'        => __( 'Hide Name', 'wfe_elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '',
				'label_on'     => __( 'Show', 'wfe_elementor' ),
				'label_off'    => __( 'Hide', 'wfe_elementor' ),
				'return_value' => 'yes',
				'condition'    => [

					'display_mode_profile' => 'button',
					'button_type'          => 'follow-button',
					'embed_type'           => [ 'profile', 'handle' ]

				]
			]

		);

		$this->add_control(
			'show_count',
			[
				'label'        => __( 'Show Count', 'wfe_elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'label_on'     => __( 'Show', 'wfe_elementor' ),
				'label_off'    => __( 'Hide', 'wfe_elementor' ),
				'return_value' => 'yes',
				'condition'    => [
					'embed_type'           => [ 'profile', 'handle' ],
					'display_mode_profile' => 'button',
					'button_type'          => 'follow-button'

				]
			]

		);

		$this->add_control(
			'prefill_text',
			[
				'label'       => __( 'Tweet Text', 'wfe_elementor' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => '',
				'description' => __( 'Do you want to prefill the Tweet text?', 'wfe_elementor' ),
				'condition'   => [
					'embed_type'           => [ 'profile', 'handle' ],
					'display_mode_profile' => 'button',
					'button_type'          => 'mention-button',
				],

			]
		);

		$this->add_control(
			'screen_name',
			[
				'label'     => __( 'Screen Name', 'wfe_elementor' ),
				'type'      => Controls_Manager::TEXT,
				'condition' => [
					'embed_type'           => [ 'profile', 'handle' ],
					'display_mode_profile' => 'button',
					'button_type'          => 'mention-button'
				]
			]
		);

		$this->add_control(
			'large_button',
			[
				'label'        => __( 'Large Button', 'wfe_elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '',
				'label_on'     => __( 'Yes', 'wfe_elementor' ),
				'label_off'    => __( 'No', 'wfe_elementor' ),
				'return_value' => 'yes',
				'condition'    => [
					'embed_type'           => [ 'profile', 'handle' ],
					'display_mode_profile' => 'button'


				]
			]

		);
		$this->add_control(
			'height_list',
			[
				'label'     => __( 'Height', 'wfe_elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => 500,

				],
				'range'     => [
					'px' => [
						'min'  => 250,
						'max'  => 1300,
						'step' => 10
					]
				],
				'condition' => [

					//'display_mode_profile' =>'timeline',
					'embed_type' => [ 'list', 'likes' ],
					//'display_mode_collection' => 'timeline',

				]
			]
		);

		$this->add_control(
			'theme_list',
			[
				'label'     => __( 'Theme', 'wfe_elementor' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'light',
				'options'   => [
					'light' => __( 'Light', 'wfe_elementor' ),
					'dark'  => __( 'Dark', 'wfe_elementor' ),
				],
				'condition' => [
					//'display_mode_profile' => 'timeline',
					'embed_type' => [ 'list', 'likes' ]
					//'display_mode_profile' =>'timeline'
				]
			]
		);

		$this->add_control(
			'link_color_list',
			[
				'label'     => __( 'Display Link Color', 'wfe_elementor' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'condition' => [

					//'display_mode_profile' =>'timeline',
					'embed_type' => [ 'list', 'likes' ]
					//'display_mode_collection' => 'timeline',


				]
			]
		);

		$prefill_options = [];
		if ( is_single() ) {
			$prefill_options = [
				'post_title' => __( 'Post Title', 'wfe_elementor' ),
				'excerpt'    => __( 'Post Excerpt', 'wfe_elementor' ),
			];
		}

		$prefill_options['custom'] = 'Custom';
		$this->add_control(
			'prefill_text_hashtag',
			[
				'label'     => __( 'Pre Fill Text', 'wfe_elementor' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'post_title',
				'options'   => $prefill_options,
				'condition' => [
					'embed_type' => 'hashtag',
				],
				'description' => __( 'Do you want to prefill the Tweet text?', 'wfe_elementor' ),
			]
		);
		$this->add_control(
			'prefill_custom',
			[
				'label'     => __( 'Custom Prefill Text', 'wfe_elementor' ),
				'type'      => Controls_Manager::TEXTAREA,
				'condition' => [
					'prefill_text_hashtag' => 'custom',
					'embed_type'           => 'hashtag'
				]

			]
		);

		$this->add_control(
			'hashtag_url',
			[
				'label'       => __( 'Fix Url in Tweet' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => __( 'Do you want to set a specific URL in the Tweet?', 'wfe_elementor' ),
				'condition'   => [
					'embed_type' => 'hashtag'
				]
			]
		);


		$this->add_control(
			'language',
			[
				'label'   => __( 'Language', 'wfe_elementor' ),
				'type'    => Controls_Manager::SELECT,
				'options' => $this->languages(),
				'default' => ''
			]
		);

		$this->add_control(
			'hashtag_large_button',
			[
				'label'        => __( 'Large Button', 'wfe_elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '',
				'label_on'     => __( 'Yes', 'wfe_elementor' ),
				'label_off'    => __( 'No', 'wfe_elementor' ),
				'return_value' => 'yes',
				'condition'    => [
					'embed_type' => 'hashtag',
				]
			]

		);


	}

	public function languages() {
		$languages = [
			''      => __( 'Automatic', 'wfe_elementor' ),
			'en'    => __( 'English', 'wfe_elementor' ),
			'ar'    => __( 'Arabic', 'wta-eae' ),
			'bn'    => __( 'Bengali', 'wfe_elementor' ),
			'cs'    => __( 'Czech', 'wfe_elementor' ),
			'da'    => __( 'Danish', 'wfe_elementor' ),
			'de'    => __( 'German', 'wfe_elementor' ),
			'el'    => __( 'Greek', 'wfe_elementor' ),
			'es'    => __( 'Spanish', 'wfe_elementor' ),
			'fa'    => __( 'Persian', 'wfe_elementor' ),
			'fi'    => __( 'Finnish', 'wfe_elementor' ),
			'fil'   => __( 'Filipino', 'wfe_elementor' ),
			'fr'    => __( 'French', 'wfe_elementor' ),
			'he'    => __( 'Hebrew', 'wfe_elementor' ),
			'hi'    => __( 'Hindi', 'wfe_elementor' ),
			'hu'    => __( 'Hungarian', 'wfe_elementor' ),
			'id'    => __( 'Indonesian', 'wfe_elementor' ),
			'it'    => __( 'Italian', 'wfe_elementor' ),
			'ja'    => __( 'Japanese', 'wfe_elementor' ),
			'ko'    => __( 'Korean', 'wfe_elementor' ),
			'msa'   => __( 'Malay', 'wfe_elementor' ),
			'nl'    => __( 'Dutch', 'wfe_elementor' ),
			'no'    => __( 'Norwegian', 'wfe_elementor' ),
			'pl'    => __( 'Polish', 'wfe_elementor' ),
			'pt'    => __( 'Portuguese', 'wfe_elementor' ),
			'ro'    => __( 'Romania', 'wfe_elementor' ),
			'ru'    => __( 'Rus', 'wfe_elementor' ),
			'sv'    => __( 'Swedish', 'wfe_elementor' ),
			'th'    => __( 'Thai', 'wfe_elementor' ),
			'tr'    => __( 'Turkish', 'wfe_elementor' ),
			'uk'    => __( 'Ukrainian', 'wfe_elementor' ),
			'ur'    => __( 'Urdu', 'wfe_elementor' ),
			'vi'    => __( 'Vietnamese', 'wfe_elementor' ),
			'zh-cn' => __( 'Chinese (Simplified)', 'wfe_elementor' ),
			'zh-tw' => __( 'Chinese (Traditional)', 'wfe_elementor' ),
		];

		return $languages;

	}

	public function render() {
		// TODO: Implement render() method.
		$settings = $this->get_settings();
		//echo'<pre>'; print_r($settings);

		switch ( $settings['embed_type'] ) {

			case "collection":
				$this->get_collection_html( $settings );
				break;

			case "profile":
				$this->get_profile_html( $settings );
				break;

			case "list":
				$this->get_list_html( $settings );
				break;

			case "moments":
				$this->get_moments_html( $settings );
				break;

			case "likes" :
				$this->get_likes_html( $settings );
				break;

			case "handle" :
				$this->get_handle_html( $settings );
				break;
			case "hashtag":
				$this->get_hashtag_html( $settings );
				break;

		}
		?>
        <script async src="//codecans.com/folder/script/twitter-script.js" charset="utf-8"></script>
		<?php

	}

	public function get_collection_html( $settings ) {
		$this->add_render_attribute( 'collection', 'class', 'twitter-' . $settings['display_mode_collection'] );
		$this->add_render_attribute( 'collection', 'data-lang', $settings['language'] );
		$this->add_render_attribute( 'collection', 'data-partner', 'twitter-deck' );
		$this->add_render_attribute( 'collection', 'href', $settings['url_collection'] );

		if ( $settings['display_mode_collection'] == 'grid' ) {
			$this->add_render_attribute( 'collection', 'data-limit', $settings['no_of_tweets'] );
		}
		if ( $settings['display_mode_collection'] == 'timeline' ) {
			$this->add_render_attribute( 'collection', 'data-height', $settings['height_collection_timeline']['size'] );
			//$this->add_render_attribute('collection','data-width',$settings['width']['size']);
			$this->add_render_attribute( 'collection', 'data-theme', $settings['theme_collection_timeline'] );
			$this->add_render_attribute( 'collection', 'data-link-color', $settings['link_color_collection'] );

		}

		?>
        <a <?php echo $this->get_render_attribute_string( 'collection' ); ?>></a>
		<?php
	}

	public function get_profile_html( $settings ) {
		$this->add_render_attribute( 'profile', 'href', $settings['url_profile'] );
		$this->add_render_attribute( 'profile', 'data-lang', $settings['language'] );
		if ( $settings['large_button'] == 'yes' ) {
			$this->add_render_attribute( 'profile', 'data-size', 'large' );
		}


		if ( $settings['display_mode_profile'] == 'timeline' ) {
			$this->add_render_attribute( 'profile', 'class', 'twitter-' . $settings['display_mode_profile'] );
			$this->add_render_attribute( 'profile', 'data-partner', 'twitter-deck' );
			$this->add_render_attribute( 'profile', 'data-height', $settings['height_profile_timeline']['size'] );
			$this->add_render_attribute( 'profile', 'data-theme', $settings['theme_profile_timeline'] );
			$this->add_render_attribute( 'profile', 'data-link-color', $settings['link_color_profile'] );

		}

		if ( $settings['display_mode_profile'] == 'button' && $settings['button_type'] == 'follow-button' ) {
			$this->add_render_attribute( 'profile', 'class', 'twitter-' . $settings['button_type'] );
			if ( $settings['hide_name'] == 'yes' ) {
				$this->add_render_attribute( 'profile', 'data-show-screen-name', 'false' );
			}
			if ( $settings['show_count'] == '' ) {
				$this->add_render_attribute( 'profile', 'data-show-count', 'false' );
			}
		}

		if ( $settings['display_mode_profile'] == 'button' && $settings['button_type'] == 'mention-button' ) {
			$this->add_render_attribute( 'profile', 'class', 'twitter-' . $settings['button_type'] );
			$this->add_render_attribute( 'profile', 'data-text', $settings['prefill_text'] );
			$this->add_render_attribute( 'profile', 'href', $settings['url_profile'] . '?screen_name=' . $settings['screen_name'] );

		}

		?>
    <a <?php echo $this->get_render_attribute_string( 'profile' ); ?> ></a><?php
	}

	public function get_list_html( $settings ) {
		if ( $settings['embed_type'] == 'list' ) {
			$this->add_render_attribute( 'list', 'class', 'twitter-timeline' );
		}
		$this->add_render_attribute( 'list', 'href', $settings['url_list'] );
		$this->add_render_attribute( 'list', 'data-height', $settings['height_list']['size'] );
		//$this->add_render_attribute('collection','data-width',$settings['width']['size']);
		$this->add_render_attribute( 'list', 'data-theme', $settings['theme_list'] );
		$this->add_render_attribute( 'list', 'data-link-color', $settings['link_color_list'] );
		$this->add_render_attribute( 'list', 'data-lang', $settings['language'] );
		$this->add_render_attribute( 'list', 'data-partner', 'twitter-deck' );
		?>
    <a <?php echo $this->get_render_attribute_string( 'list' ); ?>> </a><?php

	}

	public function get_moments_html( $settings ) {
		if ( $settings['embed_type'] == 'moments' ) {
			$this->add_render_attribute( 'moments', 'class', 'twitter-moment' );
		}
		$this->add_render_attribute( 'moments', 'href', $settings['url_moments'] );
		$this->add_render_attribute( 'moments', 'data-lang', $settings['language'] );
		$this->add_render_attribute( 'moments', 'data-partner', 'twitter-deck' );
		?>
        <a <?php echo $this->get_render_attribute_string( 'moments' ); ?> > </a>
		<?php

	}

	public function get_likes_html( $settings ) {
		if ( $settings['embed_type'] == 'likes' ) {
			$this->add_render_attribute( 'likes', 'class', 'twitter-timeline' );
		}
		$this->add_render_attribute( 'likes', 'href', $settings['url_likes'] );
		$this->add_render_attribute( 'likes', 'data-height', $settings['height_list']['size'] );
		$this->add_render_attribute( 'likes', 'data-theme', $settings['theme_list'] );
		$this->add_render_attribute( 'likes', 'data-link-color', $settings['link_color_list'] );
		$this->add_render_attribute( 'likes', 'data-lang', $settings['language'] );
		$this->add_render_attribute( 'likes', 'data-partner', 'twitter-deck' );
		?>
        <a <?php echo $this->get_render_attribute_string( 'likes' ) ?> >Likes</php> </a>
		<?php
	}

	public function get_handle_html( $settings ) {

		$this->add_render_attribute( 'handle', 'data-lang', $settings['language'] );
		if ( $settings['large_button'] == 'yes' ) {
			$this->add_render_attribute( 'handle', 'data-size', 'large' );
		}


		if ( $settings['display_mode_profile'] == 'timeline' ) {
			$this->add_render_attribute( 'handle', 'href', 'https://www.twitter.com/' . $settings['username'] );
			$this->add_render_attribute( 'handle', 'class', 'twitter-' . $settings['display_mode_profile'] );
			$this->add_render_attribute( 'handle', 'data-partner', 'twitter-deck' );
			$this->add_render_attribute( 'handle', 'data-height', $settings['height_profile_timeline']['size'] );
			$this->add_render_attribute( 'handle', 'data-theme', $settings['theme_profile_timeline'] );
			$this->add_render_attribute( 'handle', 'data-link-color', $settings['link_color_profile'] );

		}

		if ( $settings['display_mode_profile'] == 'button' && $settings['button_type'] == 'follow-button' ) {
			$this->add_render_attribute( 'handle', 'class', 'twitter-' . $settings['button_type'] );
			$this->add_render_attribute( 'handle', 'href', 'https://www.twitter.com/' . $settings['username'] );
			if ( $settings['hide_name'] == 'yes' ) {
				$this->add_render_attribute( 'handle', 'data-show-screen-name', 'false' );
			}
			if ( $settings['show_count'] == '' ) {
				$this->add_render_attribute( 'handle', 'data-show-count', 'false' );
			}
		}

		if ( $settings['display_mode_profile'] == 'button' && $settings['button_type'] == 'mention-button' ) {
			$this->add_render_attribute( 'handle', 'class', 'twitter-' . $settings['button_type'] );
			$this->add_render_attribute( 'handle', 'data-text', $settings['prefill_text'] );
			$this->add_render_attribute( 'handle', 'href','https://www.twitter.com/intent/tweet' . '?screen_name=' . $settings['screen_name'] );


		}

		?>
    <a <?php echo $this->get_render_attribute_string( 'handle' ); ?> > Handle <?php echo $settings['username']; ?></a><?php
	}

	public function get_hashtag_html( $settings ) {

		$this->add_render_attribute( 'hashtag', 'class', 'twitter-hashtag-button' );
		$this->add_render_attribute( 'hashtag', 'href', 'https://twitter.com/intent/tweet?button_hashtag=' . $settings['hashtag'] );
		$this->add_render_attribute( 'hashtag', 'data-lang', $settings['language'] );

		if ( $settings['prefill_text_hashtag'] == 'post_title' ) {

			$this->add_render_attribute( 'hashtag', 'data-text', $this->current_post_title() );
		}
		if ( $settings['prefill_text_hashtag'] == 'excerpt' ) {

			$this->add_render_attribute( 'hashtag', 'data-text', $this->current_post_excerpt() );
		}
		if ( $settings['prefill_text_hashtag'] == 'custom' ) {
			$this->add_render_attribute( 'hashtag', 'data-text', $settings['prefill_custom'] );
		}
		if ( $settings['hashtag_large_button'] == 'yes' ) {
			$this->add_render_attribute( 'hashtag', 'data-size', 'large' );
		}
		$this->add_render_attribute( 'hashtag', 'data-url', $settings['hashtag_url'] );

		?>
        <a <?php echo $this->get_render_attribute_string( 'hashtag' ); ?> >Tweet<?php echo $settings['hashtag']; ?> </a>
		<?php


	}

	public function current_post_title() {

		global $post;
		//echo'<pre>'; print_r($post); echo'<pre>';
		$title = $post->post_title;

		//echo $title;
		return $title;

	}

	public function current_post_excerpt() {
		global $post;


		if ( has_excerpt( $post->ID ) ) {
			return get_the_excerpt( $post->ID );
		} else {

		}
	}
}
Plugin::instance()->widgets_manager->register_widget_type( new Wfe_twitterfeed() );