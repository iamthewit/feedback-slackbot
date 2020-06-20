<?php

namespace Entity;

use DateTime;

class FeedbackEntity
{
    private string $id;
    private string $text;
    private DateTime $dateTime;

    /**
     * FeedbackEntity constructor.
     *
     * @param string   $id
     * @param string   $text
     * @param DateTime $dateTime
     */
    public function __construct(string $id, string $text, DateTime $dateTime)
    {
        $this->id = $id;
        $this->text = $text;
        $this->dateTime = $dateTime;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText(string $text): void
    {
        $this->text = $text;
    }

    /**
     * @return DateTime
     */
    public function getDateTime(): DateTime
    {
        return $this->dateTime;
    }

    /**
     * @param DateTime $dateTime
     */
    public function setDateTime(DateTime $dateTime): void
    {
        $this->dateTime = $dateTime;
    }
}