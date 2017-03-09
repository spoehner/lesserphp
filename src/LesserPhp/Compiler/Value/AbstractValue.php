<?php
namespace LesserPhp\Compiler\Value;

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

abstract class AbstractValue
{
	protected $options = [
		'numberPrecision'=>null,
	];

	/**
	 * AbstractValue constructor.
	 *
	 * @param array $options
	 */
	public function __construct(array $options = [])
	{
		$this->options = array_replace($this->options, $options);
	}

	/**
	 * @return string
	 */
	abstract public function getCompiled();

	/**
	 * Initialize value from old array format.
	 *
	 * @param array $value
	 *
	 * @return void
	 * @deprecated
	 */
	abstract public function initializeFromOldFormat(array $value);
}