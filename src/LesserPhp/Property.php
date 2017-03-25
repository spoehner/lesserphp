<?php

namespace LesserPhp;

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
 * @author  Stefan Pöhner <github@poe-php.de>
 *
 * @package LesserPhp
 */

abstract class Property implements \ArrayAccess
{
    /**
     * @var Parser
     */
    protected $parser;

    /**
     * @var int|null
     */
    protected $pos;

    /**
     * @var mixed
     */
    protected $value1;

    /**
     * @var mixed
     */
    protected $value2;

    /**
     * @var mixed
     */
    protected $value3;

    /**
     * Property constructor.
     *
     * @param Parser   $parser
     * @param int|null $pos
     * @param mixed    $value1
     */
    public function __construct(Parser $parser, $pos, $value1)
    {
        $this->parser = $parser;
        $this->pos    = $pos;
        $this->value1 = $value1;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return strtolower(str_replace([__NAMESPACE__.'\\', '\\', 'Property'], '', get_class($this)));
    }

    /**
     * @return int|null
     */
    public function getPos()
    {
        return $this->pos;
    }

    /**
     * @return mixed
     */
    public function getValue1()
    {
        return $this->value1;
    }

    /**
     * @param mixed $value
     */
    public function setValue1($value)
    {
        $this->value1 = $value;
    }

    /**
     * @return mixed
     */
    public function getValue2()
    {
        return $this->value2;
    }

    /**
     * @param mixed $value
     */
    public function setValue2($value)
    {
        $this->value2 = $value;
    }

    /**
     * @return mixed
     */
    public function getValue3()
    {
        return $this->value3;
    }

    /**
     * @param mixed $value
     */
    public function setValue3($value)
    {
        $this->value3 = $value;
    }

    /**
     * @inheritdoc
     */
    public function offsetExists($offset)
    {
        return (is_int($offset) && $offset >= -1 && $offset <= 3);
    }

    /**
     * @inheritdoc
     */
    public function offsetGet($offset)
    {
        if ($offset === -1) {
            return $this->getPos();
        } elseif ($offset === 0) {
            return $this->getType();
        } elseif ($offset === 1) {
            return $this->getValue1();
        } elseif ($offset === 2) {
            return $this->getValue2();
        } elseif ($offset === 3) {
            return $this->getValue3();
        } else {
            throw new \InvalidArgumentException("Unknown offset $offset");
        }
    }

    /**
     * @inheritdoc
     */
    public function offsetSet($offset, $value)
    {
        // this only happens for sub-properties
        if ($offset === 2) {
            return $this->setValue2($value);
        } else {
            throw new \InvalidArgumentException("Unknown offset $offset");
        }
    }

    /**
     * @inheritdoc
     */
    public function offsetUnset($offset)
    {
    }

    /**
     * @param Parser     $parser
     * @param string     $type
     * @param int|null   $pos
     * @param mixed      $value1
     * @param mixed|null $value2
     * @param mixed|null $value3
     *
     * @return self
     */
    public static function factory(Parser $parser, $type, $pos, $value1, $value2 = null, $value3 = null)
    {
        $className = __NAMESPACE__ . '\Property\\' . ucfirst($type) . 'Property';

        if (!class_exists($className)) {
            throw new \UnexpectedValueException("Unknown property type: $type");
        }

        $property = new $className($parser, $pos, $value1);
        if (!$property instanceof self) {
            throw new \RuntimeException("$className must extend " . self::class);
        }

        $property->setValue2($value2);
        $property->setValue3($value3);

        return $property;
    }
}
