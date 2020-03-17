<?php


namespace lShamanl\ApiManagerPlugins\Leadvertex\Entity;


class Good
{
    const MODE_ADD = 'add';
    const MODE_UPDATE = 'update';
    const MODE_DELETE = 'delete';

    /** @var int */
    private $goodID;

    /** @var int */
    private $quantity;

    /** @var int */
    private $price;

    /** @var string */
    private $name;

    /** @var int */
    private $categoryID;

    /** @var string */
    private $categoryName;

    /** @var int */
    private $purchasingPrice;

    public function __construct($goodID, $price, $quantity)
    {
        $this->goodID = $goodID;
        $this->quantity = $quantity;
        $this->price = $price;
    }

    /**
     * @param $goodId
     * @return Good
     * Расшифрока: Уникальный ID товара
     */
    public function setGoodID($goodId)
    {
        $clone = clone $this;
        $clone->goodID = $goodId;

        return $clone;
    }

    /**
     * @param string $name
     * @return Good
     * Расшифрока: Наименование товара
     */
    public function setName($name)
    {
        $clone = clone $this;
        $clone->name = $name;

        return $clone;
    }

    /**
     * @param int $quantity
     * @return Good
     * Расшифрока: Количество
     */
    public function setQuantity($quantity)
    {
        $clone = clone $this;
        $clone->quantity = $quantity;

        return $clone;
    }

    /**
     * @param int $price
     * @return Good
     * Расшифрока: Цена за указанное количество
     */
    public function setPrice($price)
    {
        $clone = clone $this;
        $clone->price = $price;

        return $clone;
    }

    /**
     * @param int $categoryID
     * @return Good
     * Расшифрока: Id категории товара
     */
    public function setCategoryID($categoryID)
    {
        $clone = clone $this;
        $clone->categoryID = $categoryID;

        return $clone;
    }

    /**
     * @param string $categoryName
     * @return Good
     * Расшифрока: Наименование категории товара
     */
    public function setCategoryName($categoryName)
    {
        $clone = clone $this;
        $clone->categoryName = $categoryName;

        return $clone;
    }

    /**
     * @param int $purchasingPrice
     * @return Good
     * Расшифрока: Закупочная цена
     */
    public function setPurchasingPrice($purchasingPrice)
    {
        $clone = clone $this;
        $clone->purchasingPrice = $purchasingPrice;

        return $clone;
    }

    /**
     * @return array
     * Возвращает сущность Good готовую к отправке через Клиент.
     */
    public function toArray()
    {
        $goodArray = [
            'goodID' => $this->goodID,
            'name' => $this->name,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'categoryID' => $this->categoryID,
            'categoryName' => $this->categoryName,
            'purchasingPrice' => $this->purchasingPrice,
        ];

        foreach ($goodArray as $key => $item) {
            if (!isset($item)) {
                unset($goodArray[$key]);
            }
        }

        return $goodArray;
    }
}