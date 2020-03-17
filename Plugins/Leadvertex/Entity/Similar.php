<?php


namespace lShamanl\ApiManagerPlugins\Leadvertex\Entity;


class Similar
{
    /** @var int */
    protected $phone;

    /** @var string */
    protected $ip;

    /**
     * Similar constructor.
     * @param int $phone
     * @param string $ip
     */
    public function __construct($phone, $ip)
    {
        $this->phone = $phone;
        $this->ip = $ip;
    }

    public function toArray()
    {
        return [
            'similar' => [
                'phone' => $this->phone,
                'ip' => $this->ip,
            ]
        ];
    }

}