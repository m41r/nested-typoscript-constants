# EXT: Nested Typoscript Constants

**ATTENTION: this extension is just an example on HOW you can achieve it. While it's not the optimal solution available,
it provides a quick and functional approach. If you discover a better solution, I'd gladly integrate it.**

### About

With the introduction of the new TypoScript Parser in Typo3 v12, the feature allowing nested constants (examples provided below)
was initially removed. For those heavily reliant on this functionality (like myself), there seemed to be limited options.
However, after raising awareness through the Forge issue [#101752](https://forge.typo3.org/issues/101752) and patch
[#81078](https://review.typo3.org/c/Packages/TYPO3.CMS/+/81078), the feature has been reinstated.
This restoration now allows us to use it again without requiring additional code adjustments on the users end.

### Examples

#### Constants:

```
normal = World
nested = Hello {$normal}
```

#### Setup:

```
page.10 = TEXT
page.10.value = {$nested}
```

#### Current output (without the patch/listener):

```
Hello {$normal}
```

#### Expected output (with the patch/listener):

```
Hello World
```

### Requirements:

- At least Typo3 **v12**
- The patch [#81078](https://review.typo3.org/c/Packages/TYPO3.CMS/+/81078) should either be already merged
   into Typo3 or added manually via [composer patches](https://github.com/cweagans/composer-patches)
