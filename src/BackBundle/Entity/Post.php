<?php
/**
 * User: floran
 * Date: 23/10/2016
 * Time: 14:57
 */

namespace BackBundle\Entity;

use BackBundle\Model\TimestampableInterface;
use BackBundle\Traits\TimestampableTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="posts")
 */
class Post implements TimestampableInterface
{
    use TimestampableTrait;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(name="public_id", type="string")
     */
    private $publicId;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="BackBundle\Entity\User")
     * @ORM\JoinColumn(name="author_user_id", referencedColumnName="id", nullable=false)
     */
    private $author;

    /**
     * @var Picture
     * @ORM\ManyToOne(targetEntity="BackBundle\Entity\Picture", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="cover_picture_id", referencedColumnName="id", nullable=false)
     */
    private $coverPicture;

    /**
     * @var Picture
     * @ORM\ManyToOne(targetEntity="BackBundle\Entity\Picture", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="thumbnail_picture_id", referencedColumnName="id", nullable=false)
     */
    private $thumbnailPicture;

    /**
     * @var ChallengeSubject
     * @ORM\ManyToOne(targetEntity="BackBundle\Entity\ChallengeSubject")
     * @ORM\JoinColumn(name="challenge_subject_id", referencedColumnName="id", nullable=false)
     */
    private $challengeSubject;

    /**
     * @var string
     * @ORM\Column(name="title", type="string")
     */
    private $title;

    /**
     * @var PostMetadata
     * @ORM\OneToOne(targetEntity="BackBundle\Entity\PostMetadata", mappedBy="post", cascade={"persist", "remove"})
     */
    private $metadata;

    /**
     * Post constructor.
     */
    public function __construct()
    {
        $this->publicId = uniqid();
    }


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
     * @return mixed
     */
    public function getPublicId()
    {
        return $this->publicId;
    }

    /**
     * @param mixed $publicId
     */
    public function setPublicId($publicId)
    {
        $this->publicId = $publicId;
    }

    /**
     * @return User
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param User $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @return Picture
     */
    public function getCoverPicture()
    {
        return $this->coverPicture;
    }

    /**
     * @param Picture $coverPicture
     */
    public function setCoverPicture($coverPicture)
    {
        $this->coverPicture = $coverPicture;
    }

    /**
     * @return Picture
     */
    public function getThumbnailPicture()
    {
        return $this->thumbnailPicture;
    }

    /**
     * @param Picture $thumbnailPicture
     */
    public function setThumbnailPicture($thumbnailPicture)
    {
        $this->thumbnailPicture = $thumbnailPicture;
    }

    /**
     * @return ChallengeSubject
     */
    public function getChallengeSubject()
    {
        return $this->challengeSubject;
    }

    /**
     * @param ChallengeSubject $challengeSubject
     */
    public function setChallengeSubject($challengeSubject)
    {
        $this->challengeSubject = $challengeSubject;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = ucfirst(strtolower($title));
    }

    /**
     * @return PostMetadata
     */
    public function getMetadata()
    {
        return $this->metadata;
    }

    /**
     * @param PostMetadata $metadata
     */
    public function setMetadata($metadata)
    {
        if ($metadata instanceof PostMetadata) {
            $metadata->setPost($this);
        }
        $this->metadata = $metadata;
    }
}