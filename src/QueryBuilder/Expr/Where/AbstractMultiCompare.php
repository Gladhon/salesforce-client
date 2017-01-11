<?php

namespace Xsolve\SalesforceClient\QueryBuilder\Expr\Where;

use Xsolve\SalesforceClient\QueryBuilder\Expr\Visitor\VisitorInterface;

abstract class AbstractMultiCompare extends AbstractWhere
{
    /**
     * @var string
     */
    private $left;

    /**
     * @var array
     */
    private $values;

    public function __construct(string $left, array $values)
    {
        $this->left = $left;
        $this->values = $values;
    }

    public function getLeft(): string
    {
        return $this->left;
    }

    public function getRight(): string
    {
        return sprintf('(%s)', implode(',', $this->values));
    }

    public function getValues(): array
    {
        return $this->values;
    }

    public function accept(VisitorInterface $visitor)
    {
        $visitor->visitMultiCompare($this);
    }

    public function update(array $values)
    {
        $this->values = $values;
    }
}
