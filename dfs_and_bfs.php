<?php

final class Node
{
    private $id;
    private $linked_list;

    public function __construct(string $id)
    {
        $this->id = $id;
        $this->linked_list = [];
    }

    public function addLink(Node $node, bool $reverse = true): Node
    {
        if (!$this->isLinked($node)) {
            $this->linked_list[] = $node;
        }

        if ($reverse) {
            $node->addLink($this, false);
        }

        return $this;

    }

    private function isLinked(Node $node): bool
    {
        foreach ($this->linked_list as $current_node) {
            if ($node->id() === $current_node->id()) {
                return true;
            }
        }

        return false;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function linkedList(): array
    {
        return $this->linked_list;
    }
}

function hasPathDFS(Node $source, Node $destination, array $visited): bool
{
    if (in_array($source, $visited)) return false;

    $visited[] = $source;
    if ($source === $destination) return true;

    foreach ($source->linkedList() as $child) {
        if (hasPathDFS($child, $destination, $visited)) {
            return true;
        }
    }
    return false;
}

function hasPathBFS(Node $source, Node $destination): bool
{
    $next_to_visit = new SplQueue();
    $visited = [];
    $next_to_visit->push($source);

    while (!$next_to_visit->isEmpty()) {
        $current_node = $next_to_visit->pop();
        if ($current_node === $destination) {
            return true;
        }

        if (in_array($current_node, $visited)) {
            continue;
        }

        $visited[] = $current_node;

        foreach ($current_node->linkedList() as $child) {
            $next_to_visit->push($child);
        }
    }

    return false;
}

$node1 = new Node(1);
$node2 = new Node(2);
$node3 = new Node(3);
$node4 = new Node(4);
$node5 = new Node(5);
$node6 = new Node(6);
$node7 = new Node(7);

$node1->addLink($node2)->addLink($node3);
$node2->addLink($node4)->addLink($node5);
$node3->addLink($node6);

var_dump(hasPathDFS($node1, $node6, []));
var_dump(hasPathDFS($node1, $node2, []));
var_dump(hasPathDFS($node1, $node7, []));
var_dump(hasPathBFS($node1, $node6));
var_dump(hasPathBFS($node1, $node2));
var_dump(hasPathBFS($node1, $node7));
