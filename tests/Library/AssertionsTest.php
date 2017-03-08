<?php
namespace Test\Library;
use LesserPhp\Color\Rgba;
use LesserPhp\Library\Assertions;

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
class AssertionsTest extends \PHPUnit\Framework\TestCase
{
	public function testAssertColorOk()
	{
		$return = new Rgba(10, 11, 12);

		$coerce = $this->createMock(\LesserPhp\Library\Coerce::class);
		$coerce->expects($this->once())->method('coerceColorObject')->with('#fff')->willReturn($return);

		$subject = new Assertions($coerce);
		$color = $subject->assertColor('#fff');
		$this->assertEquals($return->toOldArray(), $color);
	}

	/**
	 * @expectedException \LesserPhp\Exception\GeneralException
	 * @expectedExceptionMessage error message
	 */
	public function testAssertColorNotOk()
	{
		$coerce = $this->createMock(\LesserPhp\Library\Coerce::class);
		$coerce->expects($this->once())->method('coerceColorObject')->with('#fff')->willReturn(null);

		$subject = new Assertions($coerce);
		$subject->assertColor('#fff', 'error message');
	}
}