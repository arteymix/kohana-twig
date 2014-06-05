<?php

defined('SYSPATH') or die('No direct script access.');

/**
 * Parser for fragment/endfragment blocks.
 *
 * @package Twig
 * @author  Guillaume Poirier-Morency <guillaumepoiriermorency@gmail.com>
 */
class Twig_TokenParser_Fragment extends Twig_TokenParser {

    /**
     * @param \Twig_Token $token
     *
     * @return boolean
     */
    public function decideFragmentEnd(Twig_Token $token) {

        return $token->test('endfragment');
    }

    public function getTag() {

        return 'fragment';
    }

    public function parse(Twig_Token $token) {

        $stream = $this->parser->getStream();

        $name = $this->parser->getExpressionParser()->parseExpression();
        $lifetime = $this->parser->getExpressionParser()->parseExpression();
        $i18n = $this->parser->getExpressionParser()->parseExpression();

        $stream->expect(Twig_Token::BLOCK_END_TYPE);
        $body = $this->parser->subparse(array($this, 'decideFragmentEnd'), true);
        $stream->expect(Twig_Token::BLOCK_END_TYPE);

        return new Twig_Node_Fragment($name, $lifetime, $i18n, $body, $token->getLine(), $this->getTag());
    }

}
