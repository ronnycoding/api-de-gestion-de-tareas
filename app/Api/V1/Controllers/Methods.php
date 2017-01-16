<?php
/**
 * Created by PhpStorm.
 * User: Ronny
 * Date: 1/16/17
 * Time: 12:39 AM
 */
namespace App\Api\V1\Controllers;

interface Methods {
	public function show($idItem, $idOpt=null);
	public function showAll();
	public function store($idItem=null);
	public function update($idItem=null);
	public function delete($idItem, $idItemOpt=null);
}