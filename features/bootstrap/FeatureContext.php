<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    /**
     * @Given /^I am on the "([^"]*)" page$/
     */
    public function iAmOnThePage($arg1)
    {
        throw new PendingException();
    }
}
