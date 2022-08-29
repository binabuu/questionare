<?php 
  
  class Hash{
	  
	  public static function create($algorithm,$data,$salt){
		  //1.parameter $algorithm for password such as md5,sha1,whirlpool etc . 2 parameter $data is the data to encode (option).
		  //3 parameter $Salt (shhould be same throughout System)
		  // HASH_HMAC IS CONSTANT ALREADY DEFINED
		 $context =  hash_init($algorithm,HASH_HMAC,$salt);
		 hash_update($context,$data);
		 return hash_final($context);
	  }
  }