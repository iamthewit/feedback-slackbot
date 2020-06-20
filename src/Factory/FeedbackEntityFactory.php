<?php

namespace Factory;

use Entity\FeedbackEntity;
use Feedback\Feedback;

/**
 * Class FeedbackEntityFactory
 * @package Factory
 */
class FeedbackEntityFactory
{
    /**
     * @param Feedback $feedback
     *
     * @return FeedbackEntity
     */
    public static function createFromFeedback(Feedback $feedback): FeedbackEntity
    {
        return new FeedbackEntity(
            $feedback->id()->value(),
            $feedback->text(),
            \DateTime::createFromImmutable($feedback->dateTime())
        );
    }
}