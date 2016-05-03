<?php
namespace Veksa\Carrot\Tests\Types;

use Veksa\Carrot\Types\Attachment;
use Veksa\Carrot\Types\ArrayOfAttachment;

class ArrayOfAttachmentTest extends \PHPUnit_Framework_TestCase
{
    public function testFromResponse()
    {
        $actual = ArrayOfAttachment::fromResponse(
            array(
                array(
                    'id' => 1,
                    'type' => 'jpeg',
                    'size' => 600,
                    'filename' => 'testfile',
                    'mime_type' => 'image/jpeg',
                    'url' => 'http://google.ru'
                )
            )
        );

        $expected = array(
            Attachment::fromResponse(array(
                'id' => 1,
                'type' => 'jpeg',
                'size' => 600,
                'filename' => 'testfile',
                'mime_type' => 'image/jpeg',
                'url' => 'http://google.ru'
            ))
        );

        foreach ($actual as $key => $item) {
            $this->assertEquals($expected[$key], $item);
        }
    }
}