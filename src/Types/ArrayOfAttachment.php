<?php
namespace Veksa\Carrot\Types;

/**
 * Class ArrayOfAttachment
 *
 * @package Veksa\Carrot
 */
abstract class ArrayOfAttachment
{
    public static function fromResponse($data)
    {
        $array = [];
        foreach ($data as $update) {
            $array[] = Attachment::fromResponse($update);
        }
        
        return $array;
    }
}
