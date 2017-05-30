<?php

return array(
    /**
     * If not enabled it will send the metrics to nowhere
     */
    'enabled' => true,

    /**
     * The default namespace
     */
    'namespace' => null,

    /**
     * Default dimensions
     */
    'default_dimensions' => [
        'on' => [
            /** Namespace name */
            'Test' => [
                ['name' => 'test_name', 'value' => 'test_value'],
                ['name' => 'test_name', 'value' => 'test_value'],
            ]
        ]
    ],

    /**
     * Output destination, by default `cloudwatch`
     * Use `log` for debug purposes & see what is sending
     *
     * Values: cloudwatch|log
     */
    'output' => 'cloudwatch',

    /**
     * Send metrics automatically when script shutdown
     * Use to this to avoid sending manually & queue metrics on one request
     */
    'send_on_shutdown' => true,

    /**
     * Should throw exception on request failure?
     */
    'throw_exception_on_fail' => true,
);