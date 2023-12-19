<?php

return [

    'slug' => 'exceptions',

    /** Show or hide in navigation/sidebar */
    'navigation_enabled' => true,

    /** Sort order, if shown. No effect, if navigation_enabled it set to false. */
    'navigation_sort' => -1,

    /** Whether to show a navigation badge. No effect, if navigation_enabled it set to false. */
    'navigation_badge' => true,

    /** Icons to use for navigation (if enabled) and pills */
    'icons' => [
        'navigation' => 'heroicon-o-cpu-chip',
        'exception' => 'heroicon-o-cpu-chip',
        'headers' => 'heroicon-o-arrows-right-left',
        'cookies' => 'heroicon-o-circle-stack',
        'body' => 'heroicon-s-code-bracket',
        'queries' => 'heroicon-s-circle-stack',
    ],

    'is_globally_searchable' => false,

    /**-------------------------------------------------
    * Change the default active tab
    *
    * Exception => 1 (Default)
    * Headers => 2
    * Cookies => 3
    * Body => 4
    * Queries => 5
    */
    'active_tab' => 5,

    /**-------------------------------------------------
    * Here you can define when the exceptions should be pruned
    * The default is 7 days (a week)
    * The format for providing period should follow carbon's format. i.e.
    * 1 day => 'subDay()',
    * 3 days => 'subDays(3)',
    * 7 days => 'subWeek()',
    * 1 month => 'subMonth()',
    * 2 months => 'subMonths(2)',
    *
    */

    'period' => now()->subWeek(),
];
