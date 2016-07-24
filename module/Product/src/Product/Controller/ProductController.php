<?php
namespace Product\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;
use Product\Model\ProductInterface;

class ProductController extends AbstractActionController
{
	/**
	 * @var ProductInterface
	*/
	private $model;
	
	/**
	 * Constructor
	 *
	 * @param ProductInterface $model
	*/
	public function __construct(ProductInterface $model)
	{
		$this->model = $model;
	}
	
	/**
	 * Return products model
	 *
	 * @return ProductInterface
	*/
	public function getModel() : ProductInterface
	{
		return $this->model;
	}
	
	/**
     * Return list of resources
     *
     * @return JsonModel
     */
    public function listAction() : JsonModel
    {
		$tags = (array)$this->params()->fromQuery('tags');
		
		return new JsonModel($this->getModel()->getAll($tags));
    }
 
    /**
     * Return single resource
     *
     * @return JsonModel
     */
    public function getAction() : JsonModel
    {
        $id = $this->params()->fromRoute('id');

		return new JsonModel($this->getModel()->get($id));
    }
 
    /**
     * Create a new resource
     *
     * @return JsonModel
     */
    public function createAction() : JsonModel
    {
		$params = $this->params();
		
		$name  	  = $params->fromPost('name');
		$price 	  = $params->fromPost('price');
		$category = $params->fromPost('category_id');

		return new JsonModel([
			'success' => $this->getModel()->create([
				'name'     	  => $name,
				'price'	   	  => $price,
				'category_id' => $category
			])
		]);
    }
 
    /**
     * Update an existing resource
     *
     * @return JsonModel
     */
    public function updateAction() : JsonModel
    {
        $params = $this->params();
		
		$id    	  = $params->fromPost('id');
		$name  	  = $params->fromPost('name');
		$price 	  = $params->fromPost('price');
		$category = $params->fromPost('category_id');
		
		return new JsonModel([
			'success' => $this->getModel()->update($id, [
				'name'     	  => $name,
				'price'    	  => $price,
				'category_id' => $category
			])
		]);
    }
 
    /**
     * Delete an existing resource
     *
     * @return JsonModel
     */
    public function deleteAction() : JsonModel
    {
		$id = (int)$this->params()->fromPost('id');

		return new JsonModel([
			'success' => $this->getModel()->delete($id)
		]);
    }
}