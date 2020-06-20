<?php

namespace Repository;

use Entity\FeedbackEntity;
use PDO;

class SQLFeedbackRepository implements FeedbackRepositoryInterface
{
    private PDO $host;

    /**
     * SQLPeepSeaRepository constructor.
     * @param PDO $host
     */
    public function __construct(PDO $host)
    {
        $this->host = $host;
        // set error mode: https://phpdelusions.net/pdo#errors
        $this->host->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    }

    public function getAll()
    {
        // TODO: Implement getAll() method.
    }

    public function findById(): FeedbackEntity
    {
        // TODO: Implement findById() method.
    }

    public function findBy()
    {
        // TODO: Implement findBy() method.
    }

    public function store(FeedbackEntity $feedbackEntity): void
    {
        $sql = "INSERT INTO `feedback` (`id`, `text`, `datetime`) VALUES (:id, :text, :datetime)";

        $statement = $this->host->prepare($sql);
        $statement->execute([
            'id' => $feedbackEntity->getId(),
            'text' => $feedbackEntity->getText(),
            'datetime' => $feedbackEntity->getDateTime()->format('Y-m-d H:i:s'),
        ]);
    }
}