<?php
return array(
    'controllers' => array(
        'factories' => array(
            'Product\Controller\Product' => function($sm){
				$parentLocator = $sm->getServiceLocator();
				$model		   = $parentLocator->get('Product\Model\Product');
				return new Product\Controller\ProductController($model);
			},
        ),
    ),
	'router' => array(
        'routes' => array(
			'product' => array(
				'type' => 'Segment',
				'options' => array(
					'route' => '/api[/:controller][/:action][/:id]',
					'defaults' => array(
						'__NAMESPACE__' => 'Product\Controller',
					)
				),
			),
        ),
    ),
    'service_manager' => array(
        'factories' => array(
			 'Product\Model\Product' =>  function($sm) {
				 $adapter = $sm->get('Zend\Db\Adapter\Adapter');
				 $sql = new Zend\Db\Sql\Sql($adapter);
				 return new Product\Model\Product($sql);
			 },
		 ),
        
    ),
    'view_manager' => array(
		'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
);
