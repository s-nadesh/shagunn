<?php
App::uses('AppModel', 'Model');
/**
 * Vendor Model
 *
 * @property Vendorclient $Vendorclient
 * @property Vendor $Vendor
 * @property Vendorcontact $Vendorcontact
 * @property Vendorplant $Vendorplant
 */
class Banner extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'banners';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'bid';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasOne associations
 *
 * @var array
 */
	

/**
 * hasMany associations
 *
 * @var array
 */
	

}