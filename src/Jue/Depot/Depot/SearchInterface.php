<?php
/**
* @package     /src/Jue/Depot/SearchInterface
* @author      xiaocao
* @link        http://homeway.me/
* @copyright   Copyright(c) 2015
* @version     15.09.04
**/

namespace Jue\Depot;

interface SearchInterface{
	/**
	 * search file and node, support for waterfall, if post limit return waterfall data
	 * @param	string	$key		=> 	search key
	 * @param	int		$limit  	int 	=> select limit
	 * @param	int 	$offset  	int 	=> select offset
	 * @return 	array 	array("count", "node", "file") or waterfall array("count", "data")
	*/
	public function search_key($uuid, $key, $limit="", $offset="");

	/**
	 * search image file, with thumb, support for waterfall, if post limit return waterfall data
	 * @param	int		$limit  	int 	=> select limit
	 * @param	int 	$offset  	int 	=> select offset
	 * @return 	array 	waterfall array("count", "data")
	*/
	public function search_image($uuid, $format="/2/w/256/h/256/q/85/interlace/0", $limit="", $offset="");

	/**
	 * search doc, ppt, excel, docx, pdf, pptx, number, pages file, with download url, support for waterfall, if post limit return waterfall data
	 * @param	int		$limit  	int 	=> select limit
	 * @param	int 	$offset  	int 	=> select offset
	 * @return 	array 	waterfall array("count", "data")
	*/
	public function search_doc($uuid, $limit="", $offset="");

	/**
	 * search video file, with video url, support for waterfall, if post limit return waterfall data
	 * @param	int		$limit  	int 	=> select limit
	 * @param	int 	$offset  	int 	=> select offset
	 * @return 	array 	waterfall array("count", "data")
	*/
	public function search_video($uuid, $limit="", $offset="");

	/**
	 * search ai, ps file, with download url, support for waterfall, if post limit return waterfall data
	 * @param	int		$limit  	int 	=> select limit
	 * @param	int 	$offset  	int 	=> select offset
	 * @return 	array 	waterfall array("count", "data")
	*/
	public function search_source($uuid, $limit="", $offset="");
}