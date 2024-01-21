<?php
class PerHourTarif extends AbstractTarif{
    protected $pricePerKm = 0;
    protected $pricePerMin = 200/60;

    public function __construct(int $dist, int $minutes)
    {
        parent::__construct($dist, $minutes);
        $this->minutes = $this->minutes - $this->minutes % 60 + 60; // округляем до 60 минут в большую сторону
    }
}