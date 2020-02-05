Feature: Administrator login
    In order to administer the website
    The administrator should be able to login
    and see the admin dashboard after logging in

    Scenario: Visit the login page
        Given I am on the "/admin/" page
        Then I am on the "/admin/" page

#    Scenario: Successful login
#        Given I am on "/admin/"
#        Given there is 1 user available
#        And I have deposited 1 dollar
#        When I press the coffee button
#        Then I should be served a coffee
#
#    Scenario: Failed login

