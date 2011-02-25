<?php

/**
 * A clone of the "Quick Example" map shown on the Google Static Maps API
 */

include 'staticmap.class.php';

$options = array(
	'center'  =>'Brooklyn Bridge,New York,NY',
	'zoom'    =>'14',
	'size'    =>'512x512',
	'maptype' =>'roadmap',
	'sensor'  =>'false'
	);
$map = new StaticMap($options);

$styles = array(
	'color' =>'blue',
	'label' =>'S'
	);
$map->add_marker('40.702147,-74.015794', $styles);

$styles = array(
	'color' =>'green',
	'label' =>'G'
	);
$map->add_marker('40.711614,-74.012318', $styles);

$styles = array(
	'color' =>'red',
	'label' =>'C'
	);
$map->add_marker('40.718217,-73.998284', $styles);

// Display Static Map:
if ($map->is_valid())
{
	echo '<img src="' . $map->get_map() . '" alt="Google Map" ' . $map->get_size() . '>';
}
else
{
	echo 'Invalid Map!';
}


?>