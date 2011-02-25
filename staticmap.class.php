<?php

/**
* Copyright (c) 2011 Jay Williams
*
* Permission is hereby granted, free of charge, to any person obtaining a copy
* of this software and associated documentation files (the "Software"), to deal
* in the Software without restriction, including without limitation the rights
* to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
* copies of the Software, and to permit persons to whom the Software is
* furnished to do so, subject to the following conditions:
*
* The above copyright notice and this permission notice shall be included in
* all copies or substantial portions of the Software.
*
* THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
* IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
* FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
* AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
* LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
* OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
* THE SOFTWARE.
*
* @author Jay Williams
* @copyright Copyright (c) 2011, Jay Williams <www.myd3.com>
* @link https://github.com/jaywilliams/StaticMap
* @license MIT License
*
* Google Static Maps API Documentation
* http://code.google.com/apis/maps/documentation/staticmaps/
*/

class StaticMap
{
	/**
	 * Default Map Options
	 *
	 * @var array
	 */
	public $options = array(
		'size' => '400x500',
		'sensor' => 'false'
	);

	/**
	 * Default Marker Styles
	 *
	 * @var array
	 */
	public $styles = array();

	/**
	 * Set Markers
	 * Use the add_marker() method to access.
	 *
	 * @var array
	 */
	protected $markers = array();

	/**
	 * Google Static Maps API URL
	 *
	 * @var string
	 */
	public $url = 'http://maps.google.com/maps/api/staticmap?';

	/**
	 * Initialize a new static map
	 *
	 * @param array $options (optional) Sets the default map options
	 * @param array $styles (optional) Sets the default marker styles
	 */
	function __construct($options='',$styles='')
	{
		if(is_array($options))
			$this->options = array_merge($this->options, $options);

		if(is_array($styles))
			$this->styles = array_merge($this->styles, $styles);
	}

	/**
	 * Add a new marker to the map
	 *
	 * @param string $location Lat/Lng or Address
	 * @param array $styles (optional) Array containing marker-specific styles
	 * @return null
	 */
	public function add_marker($location, $styles='')
	{
		$styles = $this->encode_styles($styles);
		$this->markers[] = "$styles|$location";
	}

	/**
	 * Map Size
	 * Returns <img> compatible image dimensions
	 *
	 * Example: width="400" height="500"
	 *
	 * @return string <img> width/height attributes
	 */
	public function get_size()
	{
		$size = explode('x',$this->options['size']);

		if($size)
			return 'width="'.$size[0].'" height="'.$size[1].'"';
	}

	/**
	 * Get Map
	 * Returns a properly formatted Google Static Maps URL.
	 *
	 * @return string|bool $output <img> src attribute (returns false if required parameters are missing)
	 */
	public function get_map()
	{
		// Make sure we have a valid request to begin with!
		if(empty($this->markers) && !empty($this->options['center']) && !empty($this->options['zoom']))
			return false;

		$output = $this->url . http_build_query($this->options);

		foreach ($this->markers as $marker)
		{
			$output .= '&markers=' . urlencode($marker);
		}

		return $output;
	}

	/**
	 * Encode Marker Styles
	 * Converts a marker style array into the proper string equivalent.
	 *
	 * @param array $styles Marker-specific styles
	 * @return string
	 */
	protected function encode_styles($styles='')
	{
		if (is_array($styles))
			$styles = array_merge($this->styles, $styles);
		else
			$styles = & $this->styles;

		if(empty($styles))
			return '';

		$output = '';

		foreach ($styles as $key => $value)
		{
			$output .= "$key:$value,";
		}

		return trim($output,' ,');
	}

}



