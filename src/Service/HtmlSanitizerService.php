<?php 

namespace App\Service;

use Symfony\Component\HtmlSanitizer\HtmlSanitizer;
use Symfony\Component\HtmlSanitizer\HtmlSanitizerConfig;

class HtmlSanitizerService
{
    private $config;

    public function __construct(HtmlSanitizerConfig $config)
    {

        $this->config = (new HtmlSanitizerConfig)
            ->allowSafeElements()
            ->dropElement('p')
            ;
    }

    public function sanitize($input)
    {
        $sanitizer = new HtmlSanitizer($this->config);
        return $sanitizer->sanitize($input);
    }
}