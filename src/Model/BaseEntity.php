<?php

namespace Willydamtchou\SymfonyUtilities\Model;

abstract class BaseEntity extends BaseObject
{
    public const string ID = 'id';
    public const string DATE = 'date';
    public const string LAST_UPDATED_DATE = 'lastUpdatedDate';
    public const string STATUS = 'status';

    /**
     * @var int|null
     */
    protected ?int $id = null;

    /**
     * @var DateTime|null
     */
    protected ?DateTime $date = null;

    /**
     * @var DateTime|null
     */
    protected ?DateTime $lastUpdatedDate = null;

    /**
     * @var Status|null
     */
    protected ?Status $status = null;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->id = null;
        $this->date = new DateTime();
        $this->lastUpdatedDate = $this->date;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     *
     * @return void
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return DateTime|null
     */
    public function getDate(): ?DateTime
    {
        return $this->date;
    }

    /**
     * @param DateTime|null $date
     *
     * @return void
     */
    public function setDate(?DateTime $date): void
    {
        $this->date = $date;
    }

    /**
     * @return DateTime|null
     */
    public function getLastUpdatedDate(): ?DateTime
    {
        return $this->lastUpdatedDate;
    }

    /**
     * @param DateTime|null $lastUpdatedDate
     *
     * @return void
     */
    public function setLastUpdatedDate(?DateTime $lastUpdatedDate): void
    {
        $this->lastUpdatedDate = $lastUpdatedDate;
    }

    /**
     * @return Status|null
     */
    public function getStatus(): ?Status
    {
        return $this->status;
    }

    /**
     * @param Status|null $status
     *
     * @return void
     */
    public function setStatus(?Status $status): void
    {
        $this->status = $status;
    }
}
