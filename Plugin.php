<?php namespace Codecycler\ReadingTime;

use Backend;
use System\Classes\PluginBase;

/**
 * ReadingTime Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'ReadingTime',
            'description' => 'This plugin calculates reading time in Twig',
            'author'      => 'Codecycler',
            'icon'        => 'icon-leaf'
        ];
    }

    public function registerMarkupTags()
    {
        return [
            'filters' => [
                'readingTime' => [$this, 'calculateReadingTime'],
            ],
        ];
    }

    public function calculateReadingTime($text, $speed = 'avg')
    {
        $speedOptions = [
            'slow' => 100 / 60,
            'avg' => 130 / 60,
            'fast' => 160 / 60,
        ];

        //
        $wordCounts = str_word_count($text);

        //
        if (isset($speedOptions[$speed])) {
            $seconds = $wordCounts / $speedOptions[$speed];
        } else {
            $seconds = 0;
        }

        // Format
        return intval(date('i', mktime(0, 0, $seconds)));
    }
}
