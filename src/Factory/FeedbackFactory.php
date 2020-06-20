<?php

namespace Factory;

use Entity\FeedbackEntity;
use Feedback\Feedback;
use Feedback\FeedbackId;

/**
 * Class FeedbackFactory
 * @package Factory
 */
class FeedbackFactory
{
    /**
     * @param FeedbackEntity $feedbackEntity
     *
     * @return Feedback
     */
    public static function buildFromFeedbackEntity(FeedbackEntity $feedbackEntity): Feedback
    {
        return new Feedback(
            new FeedbackId($feedbackEntity->getId()),
            $feedbackEntity->getText(),
            \DateTimeImmutable::createFromMutable($feedbackEntity->getDateTime())
        );
    }
}