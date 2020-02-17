<?php


namespace ApiManager\Plugins\Leadvertex\Entity;


class Webmaster
{
    /** @var int */
    public $id;

    /** @var string */
    public $login;

    /** @var int */
    public $sum;

    /** @var int */
    public $paid;

    /**
     * Webmaster constructor.
     * @param int $id
     * @param string $login
     * @param int $sum
     * @param int $paid
     */
    public function __construct($id, $login, $sum, $paid)
    {
        $this->id = $id;
        $this->login = $login;
        $this->sum = $sum;
        $this->paid = $paid;
    }

    public function toArray()
    {
        return [
            'webmaster' => [
                'id' => $this->id,
                'login' => $this->login,
                'sum' => $this->sum,
                'paid' => $this->paid,
            ]
        ];
    }

}