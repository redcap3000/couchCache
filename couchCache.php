<?php
/*

couchCache
==========

Ronaldo Barbachano
Dec 2011
www.doinglines.com


Simple php5 class for storing and retrieving objects with support for APC and memcached.

Eventually will support each function for APC and memcached, and perhaps varnish.


*/

class couchCache{
	function __construct(){
//		$this->cache= new Memcached();
//		$this->cache->addServer('localhost', 11211);
	}
	
	function mc_server($servers,$action='add'){
	// server:port:weight
	// do sumcheck on weight to 100%
	// action 1 , add, 0 remove ? 
	// servers should be an array, but could take a string ?
	// ' servername:port servername:port severname:port '
		if(is_string($servers)){
			foreach(explode(' ',trim($servers)) as $server)
				$a[] = explode(':',$server,3);
		}
		elseif(is_array($servers){
			$a = $servers;
		}
		return ($this->cache->addServers($a)?true : false);
	}

	function store($id,$data=null,$db=MEMCACHED_DB){
		if($data == null){

			if( $insert['d'] = $this->cache->get($id) ){
				couchCurl::put(json_encode($insert),$id,$db);
				return true;
		// look up existing cache key (title), store to db by title as $_id
			}else
				return false;
		}else{
		
			foreach($data as $k=>$v){
			// replacing '(' with dashes for bash could put them back...
				$data[$k] = str_replace(array('(',')',',',"'"),array('-#','#-','*@','*$'),$v);
			}
			$insert['d'] = $data;
			couchCurl::put(json_encode($insert),$id,$db);
			}
	}
	
	function _apc($key,$data,$store = false){
	// default to 'retrieve', returns 2 if no change
		return ($store ==false && apc_exists($key) ? apc_fetch($key): (apc_exists($key) && apc_get($key) != $data ? apc_store($key, $data):2 ) );
	}
	
	function _apc_const($key,$constants=false,$case_sen=true){
	// pass empty $constants array() to delete constants
		if($values == false)
			return apc_load_constants($key,$case_sen);
		else
			return apc_define_constants($key,$constants);
	}
		
	
	function retrieve($title,$memcached = false,$db=MEMCACHED_DB){
	// look up title in db, put into memcached, to make it 'secure' add a cookie/session/random generated hash unique to the user
	// to the title.
		$r = json_decode(couchCurl::get($title,false,$db),true);
		if(isset($r['d']) ){
			
			//if($memcached == true ){
				//$this->cache->set($title,$r['d'],time() + CMC_TIMEOUT ) ;
				//}
			foreach($r['d'] as $loc=>$item){
				// these string replacements are mainly for the bash shell .. 
				$r['d'][$loc] = str_replace(array('-#','#-','*@','*$'),array('(',')',',',"'"),$item);
			}
			
			return $r['d'];
			}
		else
			return false;
	
	}
	/*	
	function _apc_bin($data,$action,$resource=null){
	// to do
		if(in_array($action, array ('dump','dumpfile','load','loadfile')){
		
		}else{
			return false;
		}
	
	
	}
*/	

	
}
