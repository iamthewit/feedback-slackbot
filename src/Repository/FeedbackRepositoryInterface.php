<?php

namespace Repository;

use Entity\FeedbackEntity;

interface FeedbackRepositoryInterface
{
    public function getAll();

    public function findById(): FeedbackEntity;

    public function findBy();

    public function store(FeedbackEntity $feedbackEntity);
}