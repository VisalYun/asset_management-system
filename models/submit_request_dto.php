<?php
    class SubmitRequestDto{
        public $name;
        public $on_behalf_person;
        public $borrow_asset;
        public $start_date;
        public $end_date;
        public $description;

        public function __construct($name, $on_behalf_person, $borrow_asset, $start_date, $end_date, $description) {
            $this->name = $name;
            $this->on_behalf_person = $on_behalf_person;
            $this->borrow_asset = $borrow_asset;
            $this->start_date = $start_date;
            $this->end_date = $end_date;
            $this->description = $description;
        }
    }
?>