<?php

defined('SYSPATH') or die('No direct script access.');

/**
 * Cache twig node.
 *
 * @author Guillaume Poirier-Morency <guillaumepoiriermorency@gmail.com>
 */
class Twig_Node_Fragment extends Twig_Node {

    /**
     * 
     * @param type $name
     * @param type $lifetime
     * @param type $i18n
     * @param \Twig_NodeInterface $body
     * @param type $lineno
     * @param type $tag
     */
    public function __construct(Twig_Node_Expression $name, Twig_Node_Expression $lifetime, Twig_Node_Expression $i18n, Twig_NodeInterface $body, $lineno, $tag = null) {

        parent::__construct(array('body' => $body, 'name' => $name, 'lifetime' => $lifetime, 'i18n' => $i18n), array(), $lineno, $tag);
    }

    public function compile(Twig_Compiler $compiler) {

        $compiler
                ->addDebugInfo($this)
                ->write("if ( ! Fragment::load(")
                ->subcompile($this->getNode('name'))
                ->write(', ')
                ->subcompile($this->getNode('lifetime'))
                ->write(', ')
                ->subcompile($this->getNode('i18n'))
                ->write(')) {')
                ->indent();

        $compiler
                ->subcompile($this->getNode('body'))
                ->write('Fragment::save();')
                ->outdent()
                ->write('}');
    }

}
