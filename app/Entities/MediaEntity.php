<?php
/**
 * ImageEntity.php
 *
 * @author    Bernd Engels
 * @created   02.07.19 19:31
 * @copyright Bernd Engels
 */

namespace App\Entities;

use phpDocumentor\Reflection\Types\This;

/**
 * Class MediaEntity
 */
class MediaEntity extends Entity {

    /**
     * @var int
     */
    protected $id;
	/**
	 * @var string
	 */
	protected $file_name;
	/**
	 * @var int
	 */
	protected $size;
    /**
     * @var string
     */
    protected $url;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $id
     * @return $this
     */
    public function setId($id): self
    {
        $this->id = $id;
        return $this;
    }

	/**
	 * @return int
	 */
	public function getSize() {
		return $this->size;
	}

	/**
	 * @param int $size
	 * @return $this
	 */
	public function setSize($size): self {
		$this->size = $size;
		return $this;
	}

    /**
     * @return string
     */
    public function getFileName(): string
    {
        return $this->file_name;
    }

    /**
     * @param string $file_name
     * @return $this
     */
    public function setFileName(string $file_name): self
    {
        $this->file_name = $file_name;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return $this
     */
    public function setUrl(string $url): self
    {
        $this->url = $url;
        return $this;
    }

}
