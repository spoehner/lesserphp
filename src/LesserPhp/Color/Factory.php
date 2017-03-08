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
	 * @throws \InvalidArgumentException
	 */
	public function rgbaFromArray(array $array)
	{
		if (!in_array(count($array), [4, 5]) || $array[0] !== 'color') {
			throw new \InvalidArgumentException('Unknown color format');
		}

		return $this->rgba($array[1], $array[2], $array[3], (isset($array[4]) ? $array[4] : null));
	}

	/**
	 * @param string $hexString Hexadecimal color code with optional leading #
	 *
	 * @return Rgba
	 */
	public function rgbaFromHexString($hexString)
	{
		// remove leading # if present
		$hexString = ltrim($hexString, '#');

		$channels = [0, 0, 0];
		$num      = hexdec($hexString);
		$base     = (strlen($hexString) === 3 ? 16 : 256);

		for ($i = 2; $i >= 0; $i--) {
			$t = $num % $base;
			$num /= $base;

			$channels[$i] = $t * (256 / $base) + $t * floor(16 / $base);
		}

		return $this->rgba($channels[0], $channels[1], $channels[2]);
	}

	/**
	 * @param string $string
	 *
	 * @return Rgba
	 * @throws \InvalidArgumentException
	 */
	public function rgbaFromCommaSeparatedString($string)
	{
		$array = explode(',', $string);
		if (!in_array(count($array), [3, 4])) {
			throw new \InvalidArgumentException('Unknown color format');
		}

		return $this->rgba($array[0], $array[1], $array[2], (isset($array[3]) ? $array[3] : null));
	}
}