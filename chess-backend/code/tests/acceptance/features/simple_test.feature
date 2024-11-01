Feature: Simple page check
  Scenario: Check homepage
    Given I am on "/"
    Then the response code should be 404