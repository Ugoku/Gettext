<?php
include_once dirname(__DIR__).'/src/autoloader.php';

if (!function_exists('n__')) {
    require_once(dirname(__DIR__).'/src/translator_functions.php');
}

class JedTest extends PHPUnit_Framework_TestCase
{
    public function testDynamicHeaders() {
        $translations = Gettext\Extractors\Po::fromFile(__DIR__.'/files/gettext_multiple_headers.po');
        $jsonString = Gettext\Generators\Jed::toString($translations, __DIR__.'/files/gettext_multiple_headers.json', true);

        $domain = 'testingdomain';
        $jedJson = json_decode($jsonString, true);
        $this->assertTrue(!empty($jedJson[$domain]) && $jedJson[$domain]['']['domain'] === $domain, "Domain '$domain' either missing or invalid");

        $language = 'bs';
        $this->assertEquals($language, $jedJson[$domain]['']['lang'], 'language does not match expected');
    }
}
