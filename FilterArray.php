<?php
class FilterArray extends ArrayObject 
{
    public function offsetSet($key, $val) 
    {
        if ($val instanceof IFilter) 
            return parent::offsetSet($key, $val);
        
        throw new InvalidArgumentException('Value must be a Filter');
    }
}