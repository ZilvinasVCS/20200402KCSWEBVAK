<?php
    class Car
    {
        public $gamintojas;
        public $spalva = 'zalia';
        public $atsarginisRatas = true;
        public $bakas;
        private $kebuloTipas = 'sedanas';
        //public $viesasKebuloTipas = $this->kebuloTipas;

        public function labas()
        {
            echo "Labas, Tavo automobilis yra {$this->spalva}.";
        }

        public function degaluKiekis($litrai)
        {
            $this->bakas += $litrai;
            return $this;
        }

        public function atstumas($distancija, $matoVienetas = 'km')
        {
            if ($matoVienetas === 'km')
            {
                $distancija = $distancija;

            } else if ($matoVienetas === 'mi') {
                $distancija *= 1.4;
            }

            $litrai = $distancija * 0.05;
            $this->bakas -= $litrai;
            return $this;
        }
    }

    $bmw = new Car(); // pagal tipa tai yra objektas
    $volvo = new Car();

    echo $bmw->spalva; // output: zalia
    $bmw->spalva = "raudona";
    echo $bmw->spalva; // output: raudona

    $volvo->labas();

    $bakas = $bmw->degaluKiekis(10)->atstumas(9, 'mi')->bakas;
    echo "Kuro bake liko {$bakas} litrai degalų" . "\n";
    //echo ($bmw->viesasKebuloTipas);
?>
