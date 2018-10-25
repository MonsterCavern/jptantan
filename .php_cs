<?php

$header = <<<'EOF'
This file is part of PHP CS Fixer.

(c) Fabien Potencier <fabien@symfony.com>
    Dariusz Rumiński <dariusz.ruminski@gmail.com>

This source file is subject to the MIT license that is bundled
with this source code in the file LICENSE.
EOF;

return PhpCsFixer\Config::create()
    ->setRules([
      '@PSR2'        => true,
      'array_syntax' => [
        'syntax' => 'short',
      ],
      'binary_operator_spaces' => [
        'operators' => [
          '=' =>'align_single_space_minimal',
          '=>'  => 'align_single_space_minimal',
          'xor' => null,
        ],
      ],
      'blank_line_before_return' => true,
      'concat_space'             => [
        'spacing' => 'none',
      ],
      'function_typehint_space'          => true,
      'linebreak_after_opening_tag'      => true,
      'lowercase_cast'                   => true,
      'no_extra_consecutive_blank_lines' => [
        'continue',
        'curly_brace_block',
        'extra',
        'parenthesis_brace_block',
        'square_brace_block',
        'throw',
      ],
      'no_blank_lines_after_phpdoc'                 => true,
      'no_whitespace_before_comma_in_array'         => true,
      'no_multiline_whitespace_around_double_arrow' => true,
      'not_operator_with_successor_space'           => true,
      'phpdoc_indent'                               => true,
      'single_quote'                                => true,
      // 'single_quote'                            => [
      //   'strings_containing_single_quote_chars' => true,
      // ],
      'single_blank_line_before_namespace'          => true,
      'trim_array_spaces'                           => true,
      'ternary_operator_spaces'                     => true,
      'whitespace_after_comma_in_array'             => true
    ])
    ->setCacheFile(__DIR__.'/.php_cs.cache')
;

// special handling of fabbot.io service if it's using too old PHP CS Fixer version
if (false !== getenv('FABBOT_IO')) {
    try {
        PhpCsFixer\FixerFactory::create()
            ->registerBuiltInFixers()
            ->registerCustomFixers($config->getCustomFixers())
            ->useRuleSet(new PhpCsFixer\RuleSet($config->getRules()));
    } catch (PhpCsFixer\ConfigurationException\InvalidConfigurationException $e) {
        $config->setRules([]);
    } catch (UnexpectedValueException $e) {
        $config->setRules([]);
    } catch (InvalidArgumentException $e) {
        $config->setRules([]);
    }
}

return $config;
