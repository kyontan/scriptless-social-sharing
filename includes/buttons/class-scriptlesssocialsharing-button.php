<?php

/**
 * Class ScriptlessSocialSharingButton
 * @since 3.0.0
 */
abstract class ScriptlessSocialSharingButton {

	/**
	 * The button name/key.
	 *
	 * @var string $button_name
	 */
	protected $button_name;

	/**
	 * The post attributes.
	 *
	 * @var array $attributes
	 */
	protected $attributes;

	/**
	 * The plugin setting.
	 *
	 * @var array $setting
	 */
	protected $setting;

	/**
	 * ScriptlessSocialSharingButton constructor.
	 *
	 * @param $button_name
	 * @param $attributes
	 * @param $setting
	 */
	public function __construct( $button_name, $attributes, $setting ) {
		$this->button_name = $button_name;
		$this->attributes  = $attributes;
		$this->setting     = $setting;
	}

	/**
	 * Build the URL with queries.
	 * @since 3.0.0
	 *
	 * @param $attributes
	 * @return string
	 */
	public function get_url() {
		return add_query_arg(
			$this->get_query_args(),
			$this->get_url_base()
		);
	}

	/**
	 * Get the array of query args for the sharing buttons URL.
	 * @since 3.0.0
	 *
	 * @return mixed
	 */
	abstract protected function get_query_args();

	/**
	 * Get the base part of the URL.
	 * @since 3.0.0
	 *
	 * @return mixed
	 */
	abstract protected function get_url_base();

	/**
	 * Get the permalink to be shared via the button.
	 *
	 * @param  string $button_name The name of the button, e.g. 'twitter', 'facebook'.
	 *
	 * @return string The URL to be shared.
	 */
	protected function get_permalink() {
		return rawurlencode(
			apply_filters( 'scriptlesssocialsharing_get_permalink',
				$this->attributes['permalink'],
				$this->button_name,
				$this->attributes
			)
		);
	}

	/**
	 * get the post excerpt
	 *
	 * @param string $description
	 *
	 * @return string excerpt formatted for URL
	 */
	protected function description( $description = '' ) {
		if ( has_excerpt() ) {
			$description = get_the_excerpt();
		}

		return apply_filters( 'scriptlesssocialsharing_description', $description );
	}
}