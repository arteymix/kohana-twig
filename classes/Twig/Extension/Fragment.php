<?php

defined('SYSPATH') or die('No direct script access.');

/**
 * Twig Extension to support Fragment in template.
 * 
 * Kohana fragment cache region of View.
 *
 * @package Twig
 * @author  Guillaume Poirier-Morency <guillaumepoiriermorency@gmail.com>
 */
class Twig_Extension_Fragment extends Twig_Extension {

    public function getName() {

        return 'fragment';
    }

    public function getTokenParsers() {

        return array(
            new Twig_TokenParser_Fragment(),
        );
    }

}
