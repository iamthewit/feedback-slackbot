<?php

namespace Feedback;

use ArrayIterator;
use Countable;
use DateTimeImmutable;
use IteratorAggregate;

class FeedbackSummary implements IteratorAggregate, Countable
{
    private DateTimeImmutable $from;
    private DateTimeImmutable $to;
    private array $feedbackItems;

    /**
     * FeedbackSummary constructor.
     * @param DateTimeImmutable $from
     * @param DateTimeImmutable $to
     * @param array $feedbackItems
     */
    private function __construct(
        DateTimeImmutable $from,
        DateTimeImmutable $to,
        array $feedbackItems = []
    )
    {
        $this->from = $from;
        $this->to = $to;
        $this->feedbackItems = $feedbackItems;
    }

    public static function createFromDatesAndArrayOfAnswers(
        DateTimeImmutable $from,
        DateTimeImmutable $to,
        array $feedbackItems
    ): self
    {
        $collection = new self();

        foreach ($feedbackItems as $feedbackItem) {
            if (!is_a($feedbackItem, Feedback::class)) {
                throw new FeedbackSummaryCreationException(
                    'Can only create an FeedbackSummary from an array of Feedback objects.'
                );
            }

            $collection->addFeedbackItem($feedbackItem);
        }

        return $collection;
    }

    /**
     * @return array
     */
    public function feedbackItems(): array
    {
        return $this->feedbackItems;
    }

    /**
     * @return DateTimeImmutable
     */
    public function from(): DateTimeImmutable
    {
        return $this->from;
    }

    /**
     * @return DateTimeImmutable
     */
    public function to(): DateTimeImmutable
    {
        return $this->to;
    }

    public function getIterator()
    {
        return new ArrayIterator($this->feedbackItems);
    }

    public function count()
    {
        return count($this->feedbackItems);
    }

    private function addFeedbackItem(Feedback $feedback)
    {
        $this->feedbackItems[] = $feedback;
    }
}