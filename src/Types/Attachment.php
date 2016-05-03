<?php
namespace Veksa\Carrot\Types;

use Veksa\Carrot\Exceptions\InvalidArgumentException;

/**
 * Class Attachment
 *
 * @package Veksa\Carrot
 */
class Attachment extends BaseType implements TypeInterface
{
    /**
     * {@inheritdoc}
     *
     * @var array
     */
    static protected $map = [
        'id' => true,
        'type' => true,
        'size' => true,
        'filename' => true,
        'mime_type' => true,
        'url' => true
    ];

    /**
     * Unique conversation identifier
     *
     * @var int
     */
    protected $id;

    /**
     * Type of attachment
     *
     * @var string
     */
    protected $type;

    /**
     * Size of attachment
     *
     * @var int
     */
    protected $size;

    /**
     * Name of attachment
     *
     * @var string
     */
    protected $fileName;

    /**
     * Mime type of attachment
     *
     * @var int
     */
    protected $mimeType;

    /**
     * Url to attachment
     *
     * @var int
     */
    protected $url;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @throws InvalidArgumentException
     */
    public function setId($id)
    {
        if (is_integer($id)) {
            $this->id = $id;
        } else {
            throw new InvalidArgumentException;
        }
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @throws InvalidArgumentException
     */
    public function setType($type)
    {
        if (is_string($type)) {
            $this->type = $type;
        } else {
            throw new InvalidArgumentException;
        }
    }

    /**
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param int $size
     *
     * @throws InvalidArgumentException
     */
    public function setSize($size)
    {
        if (is_integer($size)) {
            $this->size = $size;
        } else {
            throw new InvalidArgumentException;
        }
    }

    /**
     * @return string
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * @param string $fileName
     *
     * @throws InvalidArgumentException
     */
    public function setFileName($fileName)
    {
        if (is_string($fileName)) {
            $this->fileName = $fileName;
        } else {
            throw new InvalidArgumentException;
        }
    }

    /**
     * @return string
     */
    public function getMimeType()
    {
        return $this->mimeType;
    }

    /**
     * @param string $mimeType
     *
     * @throws InvalidArgumentException
     */
    public function setMimeType($mimeType)
    {
        if (is_string($mimeType)) {
            $this->mimeType = $mimeType;
        } else {
            throw new InvalidArgumentException;
        }
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     *
     * @throws InvalidArgumentException
     */
    public function setUrl($url)
    {
        if (is_string($url)) {
            $this->url = $url;
        } else {
            throw new InvalidArgumentException;
        }
    }
}
