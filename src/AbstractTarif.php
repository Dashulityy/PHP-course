<?php
abstract class AbstractTarif implements iTarif{
    protected $pricePerKm;
    protected $pricePerMin;
    protected $dist;
    protected $minutes;

    /** @var iService[] */
    protected $services = [];

    public function __construct(int $dist, int $minutes)
    {
        $this->dist = $dist;
        $this->minutes = $minutes;
    }

    public function calcPrice(): int
    {
        // итоговая сумма = цена за км* кол-во км + цена за минуту*кол-во минут
        $totalPrice = $this->pricePerKm * $this->dist + $this->pricePerMin * $this->minutes;

        // проверка на наличие доп услуг
        if($this->services){
            foreach ($this->services as $serv){
                $serv->apply($this, $totalPrice); // пересчитываем цену
            }
        }

        return $totalPrice;
    }

    public function addService(iService $service): iTarif
    {
        //добавляем услугу
        array_push($this->services, $service);
        return $this;
    }

    public function getDist(): int
    {
        return $this->dist;
    }

    public function getMinutes(): int
    {
        return $this->minutes;
    }
}