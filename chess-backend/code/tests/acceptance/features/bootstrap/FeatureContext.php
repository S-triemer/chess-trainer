<?php

namespace ChessBackend;

use Behat\Behat\Context\Context;
use Behat\MinkExtension\Context\MinkContext;

class FeatureContext extends MinkContext implements Context
{
    /**
     * @Given I am on ":page"
     */
    public function iAmOn($page)
    {
        $this->visit($page);
    }

    /**
     * @Then the response code should be :code
     */
    public function theResponseCodeShouldBe($code)
    {
        $response = $this->getSession()->getDriver()->getResponse();
        if ($response->getStatus() != $code) {
            throw new \Exception("Expected response code $code but got " . $response->getStatus());
        }
    }

    /**
     * @Then I should see :text
     */
    public function iShouldSee($text)
    {
        if (!$this->getSession()->getPage()->hasContent($text)) {
            throw new \Exception("Text '$text' not found in the page.");
        }
    }
}
