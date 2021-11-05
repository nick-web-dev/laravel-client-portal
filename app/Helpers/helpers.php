<?php

if( !function_exists('has_null_props') ){
	function has_null_props($obj, ...$props){
		foreach ( $props as $propName ){
			if( !property_exists($obj, $propName) || is_null( $obj->$propName ) ){
				return true;
			}
		}
		return false;
	}
}