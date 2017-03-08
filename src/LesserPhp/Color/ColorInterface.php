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
 * Interface ColorInterface
 */
interface ColorInterface
{
	/**
	 * Method to help with the transition to color objects
	 *
	 * @return array
	 * @deprecated
	 */
	public function toOldArray();
}