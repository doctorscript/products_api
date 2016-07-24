<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Entity\AbstractEntity;

class Menu extends AbstractEntity
{
	private $id, $name;
	
	public function setId($id)
	{
		$this->id = $id;
	}
	
	public function setName($name)
	{
		$this->name = $name;
	}
	
	public function getName()
	{
		return $this->name;
	}
}

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        //var_dump($this->getServiceLocator()->get('Zend\Stdlib\Hydrator\HydratorInterfaceEntity'));die;
		$adapter  = $this->getSErviceLocator()->get('Zend\Db\Adapter\Adapter');
		$stmt = $adapter->createStatement('SELECT id, name FROM menu WHERE id > :id', [
			'id' => 0
		])->execute();
		$resultSet = new \Zend\Db\ResultSet\ResultSet;
		$resultSet->setArrayObjectPrototype(new Menu(new \Zend\Stdlib\Hydrator\ClassMethods));
		$resultSet->initialize($stmt);
		//var_dump(count($resultSet));
		//var_dump($resultSet);
		foreach ($resultSet as $r) {
			var_dump($r->getName());
		}
		die;
		return new ViewModel();
    }
}