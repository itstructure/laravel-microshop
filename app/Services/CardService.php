<?php

namespace App\Services;

use Session;

/**
 * Class CardService
 * @package App\Services
 */
class CardService
{
    /**
     * @var string
     */
    public $containerName = 'card';

    /**
     * @var string
     */
    public $modelClassName;

    /**
     * @var string
     */
    public $modelPrimaryKey = 'id';

    /**
     * @var string
     */
    public $modelAmountKey = 'price';

    /**
     * @var array
     */
    public $modelAdditionKeys = [];

    /**
     * @var null|array
     */
    private $sessionData = null;

    /**
     * CardService constructor.
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        foreach ($config as $name => $value) {
            $this->{$name} = $value;
        }
    }

    /**
     * @return mixed
     */
    public function retrieveSessionData()
    {
        if ($this->sessionData == null) {
            $this->sessionData = Session::get($this->containerName);
        }

        return $this->sessionData;
    }

    /**
     * @param array|null $sessionData
     */
    public function fillSessionData(array $sessionData = null): void
    {
        Session::put($this->containerName, $sessionData);

        $this->sessionData = $sessionData;
    }

    /**
     * @param int $modelId
     * @param int $count
     * @return bool
     * @throws \Exception
     */
    public function putToCard(int $modelId, int $count = 1): bool
    {
        $sessionData = $this->retrieveSessionData();

        if (!empty($sessionData) && !is_array($sessionData)) {
            throw new \Exception('Session data must be an array.');
        }

        if (empty($sessionData)) {
            $sessionData = [
                $modelId => $count
            ];

        } else if (isset($sessionData[$modelId])) {
            $sessionData[$modelId] += $count;

        } else {
            $sessionData[$modelId] = $count;
        }

        $this->fillSessionData($sessionData);

        $result = $this->retrieveSessionData();

        if (empty($result)) {
            throw new \Exception('Session storage is not full.');
        }

        if (!isset($result[$modelId])) {
            throw new \Exception('Order item is not set to storage.');
        }

        return true;
    }

    /**
     * @param int $modelId
     * @param int $count
     * @return bool
     * @throws \Exception
     */
    public function setCountInCard(int $modelId, int $count): bool
    {
        $sessionData = $this->retrieveSessionData();

        if (empty($sessionData)) {
            throw new \Exception('Session storage is empty.');
        }

        if (!is_array($sessionData)) {
            throw new \Exception('Session data must be an array.');
        }

        if (!isset($sessionData[$modelId])) {
            throw new \Exception('Order item not found in a storage.');
        }

        $sessionData[$modelId] = $count;

        $this->fillSessionData($sessionData);

        return true;
    }

    /**
     * @param int $modelId
     * @return bool
     * @throws \Exception
     */
    public function removeFromCard(int $modelId): bool
    {
        $sessionData = $this->retrieveSessionData();

        if (empty($sessionData)) {
            throw new \Exception('Session storage is already empty.');
        }

        if (!is_array($sessionData)) {
            throw new \Exception('Session data must be an array.');
        }

        if (!isset($sessionData[$modelId])) {
            throw new \Exception('Order item not found in a storage.');
        }

        if (count($sessionData) > 1) {
            unset($sessionData[$modelId]);
            $this->fillSessionData($sessionData);

        } else {
            $this->clearCard();
        }

        return true;
    }

    /**
     * Clear card.
     */
    public function clearCard(): void
    {
        Session::forget($this->containerName);
        $this->sessionData = null;
    }

    /**
     * @return int
     */
    public function getTotalCount(): int
    {
        $sessionData = $this->retrieveSessionData();

        if (empty($sessionData)) {
            return 0;
        }

        return array_sum(array_values($sessionData));
    }

    /**
     * @return float
     */
    public function getTotalAmount(): float
    {
        return $this->calculateTotalAmount($this->getModelItems());
    }

    /**
     * @param array $modelItems
     * @return float
     */
    public function calculateTotalAmount(array $modelItems): float
    {
        $sessionData = $this->retrieveSessionData();

        if (empty($sessionData)) {
            return 0;
        }

        $amount = 0;

        foreach ($modelItems as $item) {
            $amount += ($item->{$this->modelAmountKey} * $sessionData[$item->{$this->modelPrimaryKey}]);
        }

        return $amount;
    }

    /**
     * @return array
     */
    public function getModelItems(): array
    {
        $sessionData = $this->retrieveSessionData();

        if (empty($sessionData)) {
            return [];
        }


        $modelClassName = $this->modelClassName;

        $modelItems = [];
        $selection = [$this->modelPrimaryKey, $this->modelAmountKey];

        foreach ($this->modelAdditionKeys as $additionKey) {
            $selection[] = $additionKey;
        }

        $models = $modelClassName::whereIn($this->modelPrimaryKey, array_keys($sessionData))->select($selection)->get();

        foreach ($models as $model) {
            $modelItems[$model->{$this->modelPrimaryKey}] = $model;
        }

        return $modelItems;
    }
}