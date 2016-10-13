<?php
interface IFilter
{
    public function getField();
    public function getOperator();
    public function getFilterValue();
}