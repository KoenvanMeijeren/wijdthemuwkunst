<?php
declare(strict_types=1);

namespace System;

/**
 * Provides an interface for the main entry point for the application.
 *
 * @package src\Core
 */
interface ApplicationInterface {

    /**
     * Runs the app.
     */
    public function run(): void;

}
