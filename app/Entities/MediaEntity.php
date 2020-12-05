<?php
/**
 * ImageEntity.php
 *
 * @author    Bernd Engels
 * @created   02.07.19 19:31
 * @copyright Webwerk Berlin GmbH
 */

namespace App\Entities;

/**
 * Class MediaEntity
 */
class MediaEntity extends Entity {

    /**
     * @var
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
	public function setSize($size) {
		$this->size = $size;
		return $this;
	}
}
