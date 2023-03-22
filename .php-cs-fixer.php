<?php

declare(strict_types=1);

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

$rules = [
    '@PSR12' => true,
    'void_return' => true,
    'visibility_required' => true,
    'whitespace_after_comma_in_array' => true,
    'trim_array_spaces' => true,
    'single_space_after_construct' => true,
    'no_trailing_comma_in_singleline' => true,
    'no_trailing_comma_in_singleline_function_call' => true,
    'trailing_comma_in_multiline' => true,
    'no_unused_imports' => true,
    'single_line_after_imports' => true,
    'clean_namespace' => true,
    'declare_strict_types' => true,
    'single_quote' => true,
];

$finder = Finder::create()
    ->in([__DIR__])
    ->exclude([
        'vendor', 'tmp', 'bootstrap/cache'
    ]);

return (new Config())
    ->setRules($rules)
    ->setFinder($finder);
