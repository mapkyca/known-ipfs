<?php

namespace IdnoPlugins\IPFS\Entities {

    class ProxiedFile extends \Idno\Entities\BaseObject
    {

	public function getStoredValue() {
	    return unserialize($this->value);
	}
	
	public function setStoredValue($value) {
	    $this->value = serialize($value);
	}
	
	/**
         * Retrieve a bit of generic data by it's data type
         * @param type $key
         */
        public static function getByCacheKey($key, $search = array(), $fields = array(), $limit = 10, $offset = 0)
        {
            $search = array_merge($search, ['cache_key' => $key]);

            if ($result = static::getFromX(get_called_class(), $search, $fields, $limit, $offset)) {
		return $result[0];
	    }
	    
	    return false;
        }

	
        public function save($add_to_feed = false, $feed_verb = 'post')
        {
            return parent::save(false, $feed_verb);
        }
    }

}

