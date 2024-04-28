Feature: Test de la recherche Google

  Scenario: Recherche de "Github" sur Google
    Given I am on "https://www.google.com"
    When I fill in "q" with "Github" in the form
    And I press "Google Search"
    Then I should see "Github" in the search results