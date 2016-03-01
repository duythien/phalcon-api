Feature: first
  My first Behat try. Don’t laugh :)

  Scenario: The Drupal installer should enable the footer block
    Given I am an anonymous user
    Given I am on the homepage
    Then I should see "Powered by Drupal"

  @web
  Scenario: On the account page the account age is displayed
    Given I am logged in as a user with the "authenticated user" role
    When I click "My account"
    Then I should see "Member for"
