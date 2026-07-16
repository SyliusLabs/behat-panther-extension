<?php

declare(strict_types=1);

use Behat\Config\Config;
use Behat\Config\Extension;
use Behat\Config\Profile;
use Behat\Config\Suite;

$profile = (new Profile('default'))
    ->withSuite(
        (new Suite('web'))
            ->withPaths(__DIR__ . '/features')
            ->withContexts('Behat\MinkExtension\Context\MinkContext')
    )
    // Behat 4 requires the fully qualified extension class name (no short-name resolution).
    ->withExtension(new Extension('Robertfausk\Behat\PantherExtension\ServiceContainer\PantherExtension'))
    // base_url is intentionally empty, see tests/Behat/behat.yml for details.
    ->withExtension(new Extension('Behat\MinkExtension\ServiceContainer\MinkExtension', [
        'browser_name' => 'chrome',
        'javascript_session' => 'javascript_chrome',
        'base_url' => '',
        'sessions' => [
            'default' => [
                'panther' => [
                    'options' => [
                        'webServerDir' => __DIR__ . '/public',
                    ],
                ],
            ],
            'javascript' => [
                'panther' => [
                    'options' => null,
                ],
            ],
            'javascript_chrome' => [
                'panther' => [
                    'options' => [
                        'browser' => 'chrome',
                        'webServerDir' => __DIR__ . '/public',
                    ],
                ],
            ],
            'javascript_firefox' => [
                'panther' => [
                    'options' => [
                        'browser' => 'firefox',
                        'webServerDir' => __DIR__ . '/public',
                    ],
                ],
            ],
        ],
    ]));

return (new Config())->withProfile($profile);
