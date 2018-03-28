<?php

namespace Is\Tests;

use Is\Is;

class IsTest extends isTestCase
{
    public function testIs_url()
    {
        $this->assertTrue(Is::is_url('https://baidu.com'));
        $this->assertFalse(Is::is_url('baidu.com'));
    }

    public function testIs_image()
    {
        $url = 'https://yyb.gtimg.com/aiplat/static/ai-demo/large/odemo-pic-1.jpg';

        $file = Is::str2file(file_get_contents($url));

        $file_false = Is::str2file(1);

        /*
         * url
         */
        $this->assertTrue(Is::is_image($url));

        /*
         * url false
         */
        $this->assertFalse(Is::is_image('https://www.baidu.com'));

        /*
         * file
         */
        $this->assertTrue(Is::is_image($file));

        /*
         * file false
         */

        $this->assertFalse(Is::is_image($file_false));

        /*
         * content
         */
        $this->assertTrue(Is::is_image(file_get_contents($url)));

        /*
         * content false
         */
        $this->assertFalse(Is::is_image(1));

        /*
         * resource
         */
        $this->assertTrue(Is::is_image(fopen($file, 'r')));

        /*
         * resource false
         */
        $this->assertFalse(Is::is_image(fopen($file_false, 'r')));

        /*
         * SplFileInfo
         */
        $this->assertTrue(Is::is_image(new \SplFileInfo($file)));

        /*
         * SplFileInfo false
         */
        $this->assertFalse(Is::is_image(new \SplFileInfo($file_false)));

        /*
         * format string
         */
        $this->assertTrue(Is::is_image($url, Is::JPG));

        /*
         * format string false
         */
        $this->assertFalse(Is::is_image($url, Is::BMP));

        /*
         * format array
         */
        $this->assertTrue(Is::is_image($url, [
                Is::JPG, Is::GIF, Is::JPEG, Is::BMP, Is::PNG,
            ]
        ));

        /*
         * format array false
         */
        $this->assertFalse(Is::is_image($url, [
                Is::GIF, Is::BMP, Is::PNG,
            ]
        ));

        unlink($file);
        unlink($file_false);
    }
}
