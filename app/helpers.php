<?php
/**
 * Helper functions
 */

if (! function_exists('_countPerPage')) {
	function _countPerPage($equipments)
	{
		if ($equipments->currentPage() === $equipments->lastPage()) {
			return $equipments->total();
		} else {
			return ($equipments->currentPage() - 1) * $equipments->count() + $equipments->count();
		}
	}
}