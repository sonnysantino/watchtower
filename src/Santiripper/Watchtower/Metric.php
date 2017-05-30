<?php

namespace Santiripper\Watchtower;

class Metric
{
    /** @var string */
    private $on;

    /** @var array */
    private $metricsData = [];

    /** @var array */
    private $defaultDimensions = [];

    /** @var array */
    protected $acceptedUnits = [
        'Seconds',
        'Microseconds',
        'Milliseconds',
        'Bytes',
        'Kilobytes',
        'Megabytes',
        'Gigabytes',
        'Terabytes',
        'Bits',
        'Kilobits',
        'Megabits',
        'Gigabits',
        'Terabits',
        'Percent',
        'Count',
        'Bytes/Second',
        'Kilobytes/Second',
        'Megabytes/Second',
        'Gigabytes/Second',
        'Terabytes/Second',
        'Bits/Second',
        'Kilobits/Second',
        'Megabits/Second',
        'Gigabits/Second',
        'Terabits/Second',
        'Count/Second',
        'None'
    ];

    /**
     * Metric constructor.
     * @param string $on
     */
    public function __construct($on)
    {
        $this->on = $on;
    }

    /**
     * @param Dimension $dimension
     * @return $this
     */
    public function addDefaultDimension(Dimension $dimension)
    {
        $this->defaultDimensions[] = $dimension;

        return $this;
    }

    /**
     * @param $name
     * @param $value
     * @param string $unit
     * @param array $dimensions
     * @param string|null $timestamp
     * @return $this
     * @throws \Exception
     */
    public function newMetric($name, $value, $unit = 'Count', array $dimensions = [], $timestamp = null)
    {
        if (!in_array($unit, $this->acceptedUnits)) {
            throw new \Exception("Unit $unit not supported");
        }

        $dimensions = array_merge($dimensions, $this->defaultDimensions);

        if ($configDimensions = config('watchtower.default_dimensions.on.' . $this->on)) {
            $configDimensionsModels = array_map(function ($data) {
                return new Dimension($data['name'], $data['value']);
            }, $configDimensions);

            $dimensions = array_merge($dimensions, $configDimensionsModels);
        }

        $this->metricsData[] = new MetricData($name, $value, $unit, $dimensions, $timestamp);

        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $metricsDataArray = array_map(function ($metric) {
            return $metric->toArray();
        }, $this->metricsData);

        $data = [
            'Namespace'  => $this->on,
            'MetricData' => $metricsDataArray
        ];

        return $data;
    }
}