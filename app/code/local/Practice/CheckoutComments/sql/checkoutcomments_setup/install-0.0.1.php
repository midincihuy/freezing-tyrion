<?php

$installer = $this;
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer->startSetup();

$table = $installer->getConnection()
	->newTable($installer->getTable('checkoutcomments/comments_table'))
	->addColumn('comment_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
		'identity' => true,
		'unsigned' => true,
		'nullable' => false,
		'primary' => true,
		), 'Comment ID')
	->addColumn('order_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
		'unsigned' => true,
		'nullable' => false,
		), 'Real Order ID')
	->addColumn('comment', Varien_Db_Ddl_Table::TYPE_TEXT, '64k', array(
		), 'Comment')
	->addForeignKey(
		$installer->getFkName(
				'checkoutcomments/comments_table',
				'order_id',
				'sales/order',
				'entity_id'
		),
		'order_id', $installer->getTable('sales/order'), 'entity_id',
		Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
	->setComment('Checkout Comments');
$installer->getConnection()->createTable($table);
/*$installer->run("
	CREATE TABLE {$this->getTable('comments_table')} (
		`comment_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Comment ID',
		`order_id` int(10) unsigned	NOT NULL COMMENT 'Real Order ID',
		`comment` text COMMENT 'Comment',
		PRIMARY KEY (`comment_id`),
		KEY `FK_CHECKOUT_COMMENTS_ORDER_ID_SALES_FLAT_ORDER_ENTITY_ID` (`order_id`),
		CONSTRAINT `FK_CHECKOUT_COMMENTS_ORDER_ID_SALES_FLAT_ORDER_ENTITY_ID`
			FOREIGN KEY (`order_id`)
			REFERENCES `sales_flat_order` (`entity_id`)
			ON DELETE CASCADE 
			ON UPDATE CASCADE
		)
	ENGINE=InnoDB
	DEFAULT CHARSET=utf8
	COMMENT='Checkout Comments'
	");*/
$installer->endSetup();
?>