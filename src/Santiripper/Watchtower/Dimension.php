<?php

namespace Santiripper\Watchtower;

/**
 * Watchtower Metric Dimension
 * @package Santiripper\Watchtower
 */
class Dimension
{
    /** @var string $name */
    public $name;

    /** @var string $name */
    public $value;

    /**
     * Dimension constructor.
     * @param $name
     * @param $value
     */
    public function __construct($name, $value)
    {
        $this->name  = $name;
        $this->value = $value;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'Name'  => $this->name,
            'Value' => $this->value
        ];
    }
}