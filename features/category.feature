# features/category.feature
Feature: Category feature
  Scenario: Adding a new category
    When I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"
    And I send a "POST" request to "/category" with body:
    """
    {
      "name": "King"
    }
    """
    And the response should be in JSON
    And the response should be equal to
    """
    "success"
    """
    And the header "Content-Type" should be equal to "application/json"

  Scenario: Edit category
    When I have category in Database with params :"1", "test"
    And  I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"
    And I send a "PUT" request to "/category" with body:
    """
    {
      "id": "1",
      "name": "King"
    }
    """
    And the response should be in JSON
    And the response should be equal to
    """
    "success"
    """
    And the header "Content-Type" should be equal to "application/json"
    And In database name is changed
    And In redis name is changed

  Scenario: Delete Category
    When I have category in Database with params :"1", "test"
    And  I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"
    And I send a "DELETE" request to "/category" with body:
    """
    {
      "id": "1"
    }
    """
    And the response should be in JSON
    And the response should be equal to
    """
    "success"
    """
    And the header "Content-Type" should be equal to "application/json"
    And In database category is delete
    And In redis category is delete

  Scenario: Get All Category
    When I have category in Database with params :"1", "test"
    And I have category in Database with params :"2", "test2"
    And  I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/category"
    And the response should be in JSON
    And the response should be equal to
    """
    [{"id":"1","name":"test"},{"id":"2","name":"test2"}]
    """
    And the header "Content-Type" should be equal to "application/json"

   Scenario: Get Single Category
     When I have category in Database with params :"1", "test"
     And  I add "Content-Type" header equal to "application/json"
     And I add "Accept" header equal to "application/json"
     And I send a "GET" request to "/category/1"
     And the response should be in JSON
     And the response should be equal to
     """
     {"id":"1","name":"test"}
     """
     And the header "Content-Type" should be equal to "application/json"