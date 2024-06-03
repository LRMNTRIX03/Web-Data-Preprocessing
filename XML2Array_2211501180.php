<?php 
// Lutfi Rizaldi Mahida 2211501180
function XML2Array_2211501180(SimpleXMLElement $parent)
{
	$array = array();
	
	foreach ($parent as $name => $element) {
		($node = & $array[$name])
			&& (1 === count($node) ? $node = array($node) : 1)
			&& $node = & $node[];
		$node = $element->count() ? XML2Array_2211501180($element) : trim($element);
	}
	
	return $array;
}
?>
	