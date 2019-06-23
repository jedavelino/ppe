<?php
/**
 * Helper functions
 */

if (! function_exists('_countPerPageTotal')) {
	function _countPerPageTotal($equipments)
	{
		if ($equipments->currentPage() === $equipments->lastPage()) {
			return $equipments->total();
		} else {
			return ($equipments->currentPage() - 1) * $equipments->count() + $equipments->count();
		}
	}
}