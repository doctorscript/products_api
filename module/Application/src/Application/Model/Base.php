<?php
namespace Application\Model;

use Zend\Db\Sql\Sql;
use Zend\Db\Sql\SqlInterface;

class Base
{
	private $sql;
	
	public function __construct(Sql $sql)
	{
		$this->sql = $sql;
	}

	protected function getSql() : Sql
	{
		return $this->sql;
	}
	
	protected function exec(SqlInterface $sqlObect)
	{
		$sql = $this->getSql();
		
		$sqlQuery = $sql->getSqlStringForSqlObject($sqlObect);

		$adapter  = $sql->getAdapter();
		$result   = $adapter->query($sqlQuery, $adapter::QUERY_MODE_EXECUTE);
		
		return $result;
	}
}