<?php
class DriverService implements iService{
    private $price = 100;

    public function apply(iTarif $tarif, &$price)
    {
        $price += $this->price;
    }
}