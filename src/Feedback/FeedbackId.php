<?php


namespace Feedback;

/**
 * Class FeedbackId
 * @package Feedback
 */
class FeedbackId
{
    private string $value;

    /**
     * FeedbackId constructor.
     *
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->value;
    }

}