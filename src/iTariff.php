<?php
interface iTarif{
    public function calcPrice(): int; //подсчет цены
    public function addService(iService $service): self; //добавление услуги
    public function getMinutes(): int; //получаем минуты
    public function getDist(): int; //получаем километры
}