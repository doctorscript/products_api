<?php
namespace Product\Model;

use Zend\Db\Sql\Sql;
use Application\Model\Base;

class Product extends Base implements ProductInterface
{
	protected $table = 'products';	
	
	public function create(array $product) : bool
	{
		$sql = $this->getSql();
		
		$insert = $sql->insert($this->table);
		$insert->values($product);

		$result = $this->exec($insert);		
		return ($result->count() == 1);
	}
	
	public function update(int $id, array $product) : bool
	{
		$sql = $this->getSql();
		
		$update = $sql->update($this->table);
		$update->set($product);
		$update->where(['id' => $id]);
		
		$result = $this->exec($update);	
		return ($result->count() == 1);
	}
	
	public function delete(int $id) : bool
	{
		$sql = $this->getSql();
		
		$delete = $sql->delete($this->table);
		$delete->where(['id' => $id]);
		
		$result = $this->exec($delete);
		return ($result->count() == 1);
	}
	
	public function get(int $id)
	{
		$sql = $this->getSql();
		
		$select = $sql->select();
		$select->from($this->table);
		$select->where(['id' => $id]);

		$statement = $sql->prepareStatementForSqlObject($select);
		return $statement->execute()->current();
	}
	
	public function getAll(array $tags = []) : array
	{
		$sql = $this->getSql();
		
		$select = $sql->select($this->table);
		if (!empty($tags)) {
			$select->join('product_tags', 'product_tags.product_id=products.id');
			$select->join('tags', 'tags.id=product_tags.tag_id');
			$select->where('tags.id', 'IN', $tags);
		}
		
		$result = $this->exec($select);
		return $result->toArray();
	}
}