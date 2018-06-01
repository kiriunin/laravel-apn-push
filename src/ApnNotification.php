<?php namespace Kiriunin\LaravelApnPush;

use Apple\ApnPush\Model\Alert;
use Apple\ApnPush\Model\Aps;
use Apple\ApnPush\Model\Payload;
use Apple\ApnPush\Model\Notification;
use Apple\ApnPush\Model\Expiration;
use Apple\ApnPush\Model\ApnId;
use Apple\ApnPush\Model\CollapseId;
use Apple\ApnPush\Model\Priority;

class ApnNotification
{
    /** @var string */
    protected $title = '';

    /** @var string */
    protected $body = '';

    /** @var string */
    protected $launchImage = '';

    /** @var string */
    protected $badge = 0;

    /** @var string */
    protected $sound = 'default';

    /** @var string */
    protected $threadId = '';

    /** @var bool */
    protected $contentAvailable = false;

    /** @var array */
    protected $customData = [];

    /** @var \DateTime|null */
    protected $expiration = null;

    /** @var Priority */
    protected $priority;

    /** @var string */
    protected $apnId = '';

    /** @var string */
    protected $collapseId = '';

    public function __construct()
    {
        $this->priority = Priority::immediately();
    }

    /**
     * @param string $title
     * @return ApnNotification
     */
    public function setTitle(string $title): ApnNotification
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @param string $body
     * @return ApnNotification
     */
    public function setBody(string $body): ApnNotification
    {
        $this->body = $body;

        return $this;
    }

    /**
     * @param string $launchImage
     * @return ApnNotification
     */
    public function setLaunchImage(string $launchImage): ApnNotification
    {
        $this->launchImage = $launchImage;

        return $this;
    }

    /**
     * @param string $badge
     * @return ApnNotification
     */
    public function setBadge(string $badge): ApnNotification
    {
        $this->badge = $badge;

        return $this;
    }

    /**
     * @param string $sound
     * @return ApnNotification
     */
    public function setSound(string $sound): ApnNotification
    {
        $this->sound = $sound;

        return $this;
    }

    /**
     * @param string $threadId
     * @return ApnNotification
     */
    public function setThreadId(string $threadId): ApnNotification
    {
        $this->threadId = $threadId;

        return $this;
    }

    /**
     * @param bool $contentAvailable
     * @return ApnNotification
     */
    public function setContentAvailable(bool $contentAvailable): ApnNotification
    {
        $this->contentAvailable = $contentAvailable;

        return $this;
    }

    /**
     * @param array $customData
     * @return ApnNotification
     */
    public function setCustomData(array $customData): ApnNotification
    {
        $this->customData = $customData;

        return $this;
    }

    /**
     * @param \DateTime $expiration
     * @return ApnNotification
     */
    public function setExpiration(\DateTime $expiration): ApnNotification
    {
        $this->expiration = $expiration;

        return $this;
    }

    /**
     * @param Priority $priority
     * @return ApnNotification
     */
    public function setPriority(Priority $priority): ApnNotification
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * @param string $apnId
     * @return ApnNotification
     */
    public function setApnId(string $apnId): ApnNotification
    {
        $this->apnId = $apnId;

        return $this;
    }

    /**
     * @param string $collapseId
     * @return ApnNotification
     */
    public function setCollapseId(string $collapseId): ApnNotification
    {
        $this->collapseId = $collapseId;

        return $this;
    }

    /**
     * @return Notification
     */
    public function create(): Notification
    {
        $alert = $this->createAlert();
        $aps = $this->createAps($alert);
        $payload = $this->createPayload($aps);

        return $this->createNotification($payload);
    }

    /**
     * @return Alert
     */
    protected function createAlert(): Alert
    {
        return (new Alert())
            ->withBody($this->body)
            ->withTitle($this->title)
            ->withLaunchImage($this->launchImage);
    }

    /**
     * @param Alert $alert
     * @return Aps
     */
    protected function createAps(Alert $alert): Aps
    {
        return (new Aps($alert))
            ->withBadge($this->badge)
            ->withSound($this->sound)
            ->withThreadId($this->threadId)
            ->withContentAvailable($this->contentAvailable);
    }

    /**
     * @param Aps $aps
     * @return Payload
     */
    protected function createPayload(Aps $aps): Payload
    {
        $payload = new Payload($aps);

        foreach ($this->customData as $name => $value) {
            $payload->withCustomData($name, $value);
        }

        return $payload;
    }

    /**
     * @param Payload $payload
     * @return Notification
     */
    protected function createNotification(Payload $payload): Notification
    {
        return (new Notification($payload))
            ->withExpiration(new Expiration($this->expiration))
            ->withPriority($this->priority)
            ->withApnId(new ApnId($this->apnId))
            ->withCollapseId(new CollapseId($this->collapseId));
    }
}