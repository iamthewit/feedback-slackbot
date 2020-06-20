<?php

namespace Repository;

interface FeedbackRepositoryInterface
{
    public function getAll();

    public function findById();

    public function findBy();
}