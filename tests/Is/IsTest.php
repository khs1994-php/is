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
        $this->assertTrue(Is::is_image('https://yyb.gtimg.com/aiplat/static/ai-demo/large/odemo-pic-1.jpg'));
        $this->assertFalse(Is::is_image('odemo-pic-1.jpg'));
        $this->assertTrue(Is::is_image('https://yyb.gtimg.com/aiplat/static/ai-demo/large/odemo-pic-1.jpg', Is::JPG));
    }
}
