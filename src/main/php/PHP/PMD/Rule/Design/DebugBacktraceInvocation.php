<?php

class PHP_PMD_Rule_Design_DebugBacktraceInvocation extends PHP_PMD_AbstractRule implements PHP_PMD_Rule_IFunctionAware, PHP_PMD_Rule_IMethodAware
{
    public function apply(PHP_PMD_AbstractNode $node)
    {
        foreach ($node->findChildrenOfType('Invocation') as $invocation) {
            if ('debug_backtrace' === strtolower(array_pop(explode('\\', $invocation->getName())))) {
                $this->addViolation($invocation, array($node->getType(), $node->getName()));
            }
        }
    }
}
