<?php

namespace Feedback;

use DateTimeImmutable;

class Feedback
{
    private FeedbackId $id;
    private string $text;
    private DateTimeImmutable $dateTime;

    /**
     * Feedback constructor.
     *
     * @param FeedbackId        $id
     * @param string            $text
     * @param DateTimeImmutable $dateTime
     */
    public function __construct(FeedbackId $id, string $text, DateTimeImmutable $dateTime)
    {
        $this->id       = $id;
        $this->text     = $text;
        $this->dateTime = $dateTime;
    }

    /**
     * @return FeedbackId
     */
    public function id(): FeedbackId
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function text(): string
    {
        return $this->text;
    }

    /**
     * @return DateTimeImmutable
     */
    public function dateTime(): DateTimeImmutable
    {
        return $this->dateTime;
    }

}