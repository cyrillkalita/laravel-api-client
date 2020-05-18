<?php

namespace MacsiDigital\API\Support\Relations;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;

class BelongsTo extends Relation
{
    protected $relation;

    public $type = 'BelongsTo';

    public function __construct($related, $owner, $name, $field, array $data = [])
    {
        $this->relatedClass = $related;
        $this->related = new $related($owner->client);
        $this->owner = $owner;
        $this->name = $name;
        $this->field = $field;
    }

    protected function hydrate($data) 
    {
        if($data != []){
            $this->relation = $this->related->newFromBuilder($data);
        } else {
            $this->relation = $this->related->newInstance();
        } 
    }

    public function getResults()
    {
    	if($this->relation->exists()){
    		return $this->relation;
    	} else if(isset($owner->$field) && $owner->$field != null) {
    		return $this->relation = $this->related->newQuery()->find($owner->$field);
    	} else {
    		return $this->relation;
    	}
    }

}