<?php
declare(strict_types=1);

namespace System;

/**
 * Provides an interface for the main entry point for the application.
 *
 * @package System
 */
interface ApplicationInterface {

    /**
     * Runs the app.
     *
     * @return never
     *   Returns and echoes the output of running the app.
     */
    public function run(): never;

}
