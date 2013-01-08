@technical @reflection @class
Feature: Get the structure of any class
  As application standard user
  I should be able to make reflection on a class
  In order to get information about the structure of the class

  Background:
    Given I am a standard user

  Scenario: Get the methods of class
    Given that the class "class1" exists
    And the class "class1" has the following methods:
      | name    |
      | method1 |
      | method2 |
    When I analyse the structure of the class
    Then I am informed that the class "class1" contains "2" methods
    Then I am informed that the class "class1" contains the following methods:
      | name    |
      | method1 |
      | method2 |

  Scenario: Get meta-tag informations about class
    Given that the class "class1" exists
    And the class "class1" is tagged with "@author jeff"
    When I analyse the structure of the class
    Then I am informed that the tag "author" of class "class1" has a value "jeff"