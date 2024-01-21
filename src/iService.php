<?php
interface iService{
    public function apply(iTarif $tarif, &$price); // метод применения услуги к тарифу
}