<?php

include 'staticmap.class.php';

$options = array('size'=>'300x300');
$map = new StaticMap($options);

$map->add_marker('1600 Pennsylvania Ave NW, Washington D.C., DC 20500');

$styles = array('color'=>'blue');
$map->add_marker('Lincoln Memorial Circle, Washington D.C., DC 20037', $styles);

$styles = array('label'=>'C');
$map->add_marker('38.891300,-77.03000', $styles);

// Display Static Map (using magic methods)
echo "<img src=\"$map\" alt=\"Google Map\" $map->dimensions>";

?>