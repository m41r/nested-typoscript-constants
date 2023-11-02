<?php

namespace M41r\NestedTyposcriptConstants\EventListeners;

use TYPO3\CMS\Core\TypoScript\AST\Node\ChildNodeInterface;
use TYPO3\CMS\Frontend\Event\ModifyTypoScriptConstantsEvent;

final class ModifyTypoScriptConstantsAstEventListener
{
    private array $flatConstants = [];

    public function __invoke(ModifyTypoScriptConstantsEvent $event): void
    {
        $constantsAst = $event->getConstantsAst();
        $this->flatConstants = $constantsAst->flatten();

        foreach ($constantsAst->getNextChild() as $child) {
            $this->changeNodes($child);
        }
        $event->setConstantsAst($constantsAst);
    }

    private function changeNodes(ChildNodeInterface $node): void
    {
        if (! $node->isValueNull()) {
            $node->setValue(
                $this->replaceNestedConstants($node->getValue())
            );
        }
        foreach ($node->getNextChild() as $child) {
            $this->changeNodes($child);
        }
    }

    private function replaceNestedConstants(string $constantValue): string
    {
        $isAtLeastOneNested = (bool)preg_match_all('/{\$([^}]+)}/', $constantValue, $matches);
        if ($isAtLeastOneNested) {
            foreach ($matches[1] as $id => $match) {
                $resolvedConstantValue = $this->flatConstants[$match] ?? null;
                if ($resolvedConstantValue !== null) {
                    $constantValue = (string)str_replace(
                        $matches[0][$id],
                        $this->replaceNestedConstants($resolvedConstantValue),
                        $constantValue
                    );
                }
            }
        }

        return $constantValue;
    }
}
