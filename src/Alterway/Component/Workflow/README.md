# Workflow Component

This component provides a workflow engine written as a PHP library.

Instead of modeling a workflow as a Petri net or trying to enumerate workflow patterns, the library consider a workflow as a simple directed graph: vertices model nodes and edges model transitions.

### Nodes

A node represents a point in a life cycle.
The `Node` class implements the concept.
A node is referenced by a unique name across the workflow.
The constraint is the responsibility of `NodeMap` class.

### Transitions

A transition is a link between nodes.
The `Transition` class implements the concept.
At creation, a transition is given a specification object implementing the `SpecificationInterface`.
the specification is used as a business rule to decide where to advance in the workflow.

### Tokens

A token is a simple string used to initialize the workflow in a particular node.
The idea is to consider the token as a thing placed at the center of a node.
When workflow engine is on, the token is moving from node to node.

### Events

An event is an object created each time a token arrives at a node.
The `Event` class implements the concept.
This class extends the `Event` class from the Symfony EventDispatcher component.
You can write listener or subscribers to implement any business behaviour.

## Usage

TODO

## Contributing

Pretty please, with sugar on top, atoum tests are provided and should be green when contributing code.

## References

### Theory

* [Petri net](http://en.wikipedia.org/wiki/Petri_net)
* [Workflow patterns](http://www.workflowpatterns.com/)
* [Graph theory](http://en.wikipedia.org/wiki/Graph_theory)
* [Specification pattern](http://en.wikipedia.org/wiki/Specification_pattern)

### Workflows in PHP

* [An activity based workflow engine](http://www.tonymarston.net/php-mysql/workflow.html)
* [eZ Workflow component](http://www.ezcomponents.org/docs/api/latest/introduction_Workflow.html)
* [Yii simpleWorkflow extension](http://www.yiiframework.com/extension/simpleworkflow/)
* [Galaxia workflow engine](http://workflow.tikiwiki.org/tiki-index.php?page=homepage)

## Licencing

See the bundled LICENSE file for details.

## Sponsors

* [Alter Way](http://www.alterway.fr)
* [La Ruche Qui Dit Oui !](http://www.laruchequiditoui.fr)
