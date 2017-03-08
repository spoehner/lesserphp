<?php
namespace Test\Library;

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
use LesserPhp\Color\ColorInterface;
use LesserPhp\Color\Rgba;
use LesserPhp\Library\Coerce;

/**
 * Class CoerceColorTest
 * This is an acceptance test to aid in the refactoring of colors.
 */
class CoerceColorTest extends \PHPUnit\Framework\TestCase
{
	/**
	 * @param array|ColorInterface $input
	 * @param array|null           $expected
	 *
	 * @dataProvider colorProvider
	 */
	public function testCoerceColor($input, array $expected = null)
	{
		$subject = new Coerce();
		$result  = $subject->coerceColor($input);
		$this->assertEquals($expected, $result);
	}

	public function colorProvider()
	{
		return [
			[['foo'], null],
			[['color', 10, 11, 12], ['color', 10, 11, 12]],
			[['raw_color', '#fa0da8'], ['color', 250, 13, 168]],
			[['raw_color', '#fa4'], ['color', 255, 170, 68]],
			[['keyword', 'plum'], ['color', 221, 160, 221]],
			[['keyword', 'transparent'], ['color', 0, 0, 0, 0]],
			[new Rgba(10, 11, 12, .2), ['color', 10, 11, 12, .2]],
		];
	}
}