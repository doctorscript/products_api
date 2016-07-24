<?php
namespace Product\Model;

interface ProductInterface
{
	public function create(array $product) : bool;
	public function update(int $id, array $product) : bool;
	public function delete(int $id) : bool;
	public function get(int $id);
	public function getAll() : array;
}