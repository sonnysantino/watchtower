<?php

namespace Santiripper\Watchtower;

/**
 * Class MetricData
 * @package Santiripper\Watchtower
 */
class MetricData
{
    /** @var string */
    private $name;

    /** @var string */
    private $timestamp;

    /** @var int */
    private $value;

    /** @var string */
    private $unit;

    /** @var array */
    private $dimensions = [];

    /**
     * Metric constructor.
     * @param $name
     * @param $value
     * @param $unit
     * @param $timestamp
     * @param array $dimensions
     */
    public function __construct($name, $value, $unit, array $dimensions = [], $timestamp = null)
    {
        $this->name = $name;
        $this->setTimestamp($timestamp);
        $this->value = $value;
        $this->unit = $unit;
        $this->dimensions = $dimensions;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * @param mixed $timestamp
     */
    public function setTimestamp($timestamp = null)
    {
        if (is_null($timestamp)) {
            $this->timestamp = time();
        } elseif (is_string($timestamp)) {
            $this->timestamp = strtotime($timestamp);
        /*} elseif (is_object($timestamp)) {
            $this->timestamp = $timestamp->toDateString();*/
        } else {
            $this->timestamp = $timestamp;
        }
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue(int $value)
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * @param mixed $unit
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;
    }

    /**
     * @return array
     */
    public function getDimensions()
    {
        return $this->dimensions;
    }

    /**
     * @param Dimension $dimension
     * @return $this
     */
    public function addDimension(Dimension $dimension)
    {
        $this->dimensions[] = $dimension;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $dimensions = array_map(function (Dimension $dimension) {
            return $dimension->toArray();
        }, $this->dimensions);

        $data = [
            'MetricName'    => $this->name,
            'Timestamp'     => $this->timestamp,
            'Value'         => $this->value,
            'Unit'          => $this->unit,
            'Dimensions'    => $dimensions
        ];

        return $data;
    }
}