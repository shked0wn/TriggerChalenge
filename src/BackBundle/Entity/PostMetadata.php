<?php
/**
 * Created by PhpStorm.
 * User: floranpagliai
 * Date: 11/02/2017
 * Time: 21:57
 */

namespace BackBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="post_metadatas")
 */
class PostMetadata
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(name="camera_model", type="string", nullable=true)
     */
    private $cameraModel;

    /**
     * @var string
     * @ORM\Column(name="exposure", type="string", nullable=true)
     */
    private $exposure;

    /**
     * @var string
     * @ORM\Column(name="iso", type="string", nullable=true)
     */
    private $iso;

    /**
     * @var string
     * @ORM\Column(name="aperture", type="string", nullable=true)
     */
    private $aperture;

    /**
     * @var integer
     * @ORM\Column(name="focal_length", type="integer", nullable=true)
     */
    private $focalLength;

    /**
     * @var integer
     * @ORM\Column(name="focal_length_35mm", type="integer", nullable=true)
     */
    private $focalLengthIn35mm;

    /**
     * @var string
     * @ORM\Column(name="lens", type="string", nullable=true)
     */
    private $lens;

    /**
     * @var \DateTime
     * @ORM\Column(name="taken_date", type="datetime", nullable=true)
     */
    private $takenDate;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getCameraModel()
    {
        return $this->cameraModel;
    }

    /**
     * @param string $cameraModel
     */
    public function setCameraModel($cameraModel)
    {
        $this->cameraModel = $cameraModel;
    }

    /**
     * @return string
     */
    public function getExposure()
    {
        return $this->exposure;
    }

    /**
     * @param string $exposure
     */
    public function setExposure($exposure)
    {
        $this->exposure = $exposure;
    }

    /**
     * @return string
     */
    public function getIso()
    {
        return $this->iso;
    }

    /**
     * @param string $iso
     */
    public function setIso($iso)
    {
        $this->iso = $iso;
    }

    /**
     * @return string
     */
    public function getAperture()
    {
        return $this->aperture;
    }

    /**
     * @param string $aperture
     */
    public function setAperture($aperture)
    {
        $this->aperture = $aperture;
    }

    /**
     * @return integer
     */
    public function getFocalLength()
    {
        return $this->focalLength;
    }

    /**
     * @param integer $focalLength
     */
    public function setFocalLength($focalLength)
    {
        $this->focalLength = $focalLength;
    }

    /**
     * @return integer
     */
    public function getFocalLengthIn35mm()
    {
        return $this->focalLengthIn35mm;
    }

    /**
     * @param integer $focalLengthIn35mm
     */
    public function setFocalLengthIn35mm($focalLengthIn35mm)
    {
        $this->focalLengthIn35mm = $focalLengthIn35mm;
    }

    /**
     * @return string
     */
    public function getLens()
    {
        return $this->lens;
    }

    /**
     * @param string $lens
     */
    public function setLens($lens)
    {
        $this->lens = $lens;
    }

    /**
     * @return \DateTime
     */
    public function getTakenDate()
    {
        return $this->takenDate;
    }

    /**
     * @param \DateTime $takenDate
     */
    public function setTakenDate($takenDate)
    {
        $this->takenDate = $takenDate;
    }
}