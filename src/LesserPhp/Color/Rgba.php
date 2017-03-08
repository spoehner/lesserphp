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

/**
 * Class Rgba
 */
class Rgba implements ColorInterface
{
	public $red, $green, $blue, $alpha;

	/**
	 * Rgba constructor.
	 *
	 * @param int   $red
	 * @param int   $green
	 * @param int   $blue
	 * @param float $alpha
	 */
	public function __construct($red, $green, $blue, $alpha = null)
	{
		$this->red   = $red;
		$this->green = $green;
		$this->blue  = $blue;
		$this->alpha = $alpha;
	}

	/**
	 * @inheritdoc
	 */
	public function toOldArray()
	{
		$array = ['color', $this->red, $this->green, $this->blue];

		if ($this->alpha !== null) {
			$array[] = $this->alpha;
		}

		return $array;
	}
}