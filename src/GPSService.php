<?php
class GPSService implements iService{
    private $pricePerHour = 15;

    public function apply(iTarif $tarif, &$price)
    {
        $hours = ceil($tarif->getMinutes() / 60);
        $price += $this->pricePerHour * $hours;
    }
}