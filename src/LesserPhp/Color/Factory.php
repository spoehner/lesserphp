<?php
namespace LesserPhp\Color;

/**
 * lesserphp
 * https://www.maswaba.de/lesserphp
 *
 * LESS CSS compiler, adapted from http://lesscss.org
 *
 * Copyright 2013, Leaf Corcoran <leafot@gmail.com>
 * Copyright 2016, Marcus Schwarz <github@maswaba.de>
 * Copyright 2017, Stefan Pöhner <github@poe-php.de>
 * Licensed under MIT or GPLv3, see LICENSE
 *
 * @package LesserPhp
 */
use LesserPhp\Exception\GeneralException;

/**
 * Class Factory
 * Factory to create the various color types.
 */
class Factory
{
	/**
	 * @param int        $r
	 * @param int        $g
	 * @param int        $b
	 * @param float|null $a
	 *
	 * @return Rgba
	 */
	public function rgba($r, $g, $b, $a = null)
	{
		// nothing fancy for the moment
		return new Rgba($r, $g, $b, $a);
	}

	/**
	 * Get rgba color from array format.
	 *
	 * @param array $array
	 *
	 * @return Rgba
	 * @throws GeneralException
	 */
	public function rgbaFromArray(array $array)
	{
		if (!in_array(count($array), [4, 5]) || $array[0] !== 'color') {
			throw new GeneralException('Unknown color format');
		}

		return $this->rgba($array[1], $array[2], $array[3], (isset($array[4]) ? $array[4] : null));
	}
}