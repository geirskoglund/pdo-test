<?php
class Filter implements IFilter
{
    private $field;
    private $operator;
    private $value;
    
    public function __construct($field, $operator, $value)
    {
        $this->field = $field;
        $this->operator = $operator;
        $this->value = $value;
    }
    
    public function getField()
    {
        return $this->field;
    }
    
    public function getOperator()
    {
        return $this->operator;
    }
    
    public function getFilterValue()
    {
        return $this->value;
    }
}