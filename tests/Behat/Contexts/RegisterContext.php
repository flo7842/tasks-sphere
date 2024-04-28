<?php

declare(strict_types=1);

namespace App\Tests\Contexts;

use App\Entity\User;
use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\MinkExtension\Context\MinkContext;
use Doctrine\ORM\EntityManagerInterface;

final class RegisterContext extends MinkContext implements Context
{
    /**
     * @When I fill in :arg1 with :arg2 in the form
     */
    public function iFillInWithInTheForm($field, $value)
    {
        $this->fillField($field, $value);
    }

    /**
     * @When I press :arg1
     */
    public function iPress($button)
    {
        $this->pressButton($button);
    }

    /**
     * @Then I should see :arg1 in the search results
     */
    public function iShouldSeeInTheSearchResults($text)
    {
        $this->assertPageContainsText($text);
    }

}
