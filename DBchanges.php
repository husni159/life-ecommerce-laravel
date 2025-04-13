registration input
categories[0]=170&supplier[supm_market]=170&supplier[supm_name]=New market&supplier[supm_email]=husnilvl4@sdf.sdf&user[usr_first_name]=husnilvl4&user[usr_last_name]=Sameena&user[usr_password]=123456&user[usr_password_confirm]=123456&user[usr_phone]=8555666666&user[usr_address]=asdasd&upn_phone_number[0][code]=91&upn_phone_number[0][number]=9846228871&user[supm_ref_number]=21380
*************************************

ALTER TABLE `cpnl_products_order_master` ADD `ordm_delivery_boy` INT(11) NOT NULL DEFAULT '0' AFTER `ordm_pg_response`;
ALTER TABLE `cpnl_supplier_master` ADD `supm_countr_code` VARCHAR(11) NOT NULL AFTER `supm_viewed_by`;
INSERT INTO `cpnl_groups` (`id`, `name`, `grp_slug`, `description`, `grp_access`) VALUES (NULL, 'Virtual Shop Partner', 'DB', 'Virtual Shop Partner', NULL);
ALTER TABLE `cpnl_supplier_contacts` ADD `phone_code` INT(11) NOT NULL AFTER `spc_master_id`;
ALTER TABLE `cpnl_category` ADD `virtual_store_stat` VARCHAR(25) NOT NULL DEFAULT 'no' AFTER `cat_added_by`;

CREATE TABLE `cpnl_virtshop_prod_town_assoc` (
  `vsc_id` int(11) NOT NULL,
  `vsc_cat_id` int(11) NOT NULL,
  `vsc_town_id` int(11) NOT NULL,
  `vsc_added_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
ALTER TABLE `cpnl_virtshop_catog_town_assoc` CHANGE `vsc_id` `vsc_id` INT(11) NOT NULL AUTO_INCREMENT, add PRIMARY KEY (`vsc_id`);

//neww
//ALTER TABLE `cpnl_products_category` ADD `category_type` INT(11) NOT NULL DEFAULT '0' COMMENT '1--Normal,1--virtual shop vategory' AFTER `pcat_is_name_pendent`;
//ALTER TABLE `cpnl_products_category` CHANGE `category_type` `category_type` INT(11) NOT NULL DEFAULT '0' COMMENT '0--Normal,1--virtual shop vategory';
 

 check whether virtul product is getting in search   --->searchProducts

 UPDATE `cpnl_groups` SET `grp_slug` = 'VSP' WHERE `cpnl_groups`.`id` = 11;

 ALTER TABLE `cpnl_products_stock_master` ADD `psm_group_id` INT(11) NOT NULL AFTER `psm_status`;

 ALTER TABLE `cpnl_market_places` ADD `mar_virt_store_stat` INT(11) NOT NULL DEFAULT '0' AFTER `mar_added_by`;
 ALTER TABLE `cpnl_market_places` ADD `mar_virtual_store_name` VARCHAR(100) NOT NULL AFTER `mar_virt_store_stat`;

 ALTER TABLE `cpnl_market_places` CHANGE `mar_virtual_store_name` `mar_virtual_store_name` VARCHAR(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'K STORE';
 UPDATE `cpnl_market_places` SET `mar_virtual_store_name`='K STORE' WHERE 1
******************************************UPDATED IN EXCEL *******************************************************************************

CREATE TABLE `cpnl_virtshop_user_town` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `town_id` int(11) NOT NULL,
  `validity` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `cpnl_virtshop_user_town`
  ADD PRIMARY KEY (`id`);


  ALTER TABLE `cpnl_virtshop_user_town`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

ALTER TABLE `cpnl_products_category` ADD `pcat_group` INT(11) NOT NULL AFTER `pcat_virt_cat_icon`;
ALTER TABLE `cpnl_products_category` CHANGE `pcat_group` `pcat_virtual_stat` INT(11) NOT NULL;



CREATE TABLE `cpnl_virtshop_town_stock_assoc` (
  `vtsa_id` int(11) NOT NULL,
  `vtsa_town_id` int(11) NOT NULL,
  `vtsa_stock_master_id` int(11) NOT NULL,
  `vtsa_virt_user_id` int(11) NOT NULL,
  `vtsa_supm_id` int(11) NOT NULL COMMENT 'supm_id in supplier_master,  0- for kleemz product'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


ALTER TABLE `cpnl_virtshop_town_stock_assoc`
  ADD PRIMARY KEY (`vtsa_id`);
ALTER TABLE `cpnl_virtshop_town_stock_assoc`
  MODIFY `vtsa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;


  ALTER TABLE `cpnl_supplier_master` ADD `supm_virt_free_shop` INT(11) NOT NULL AFTER `supm_countr_code`;
  ALTER TABLE `cpnl_supplier_master` ADD `supm_virt_paid_listing` INT(11) NOT NULL AFTER `supm_virt_free_shop`;
  ALTER TABLE `cpnl_virtshop_town_stock_assoc` ADD `vtsa_supm_id` INT(11) NOT NULL COMMENT 'supm_id in supplier_master, 0- for kleemz product' AFTER `vtsa_virt_user_id`;

*************************************UPDATED IN EXCEL*****************************************************************
  cpnl_user_balance

 
  a:1:{s:12:"virtual_shop";a:10:{i:0;s:6:"status";i:1;s:9:"add_stock";i:2;s:10:"stock_list";i:3;s:11:"updatestock";i:4;s:8:"category";i:5;s:20:"changecategorystatus";i:6;s:13:"get_all_towns";i:7;s:10:"view_stock";i:8;s:13:"category_view";i:9;s:29:"get_product_parent_categories";}}

  ALTER TABLE `cpnl_supplier_master` ADD `supm_paid_listing_charge` DOUBLE NOT NULL AFTER `supm_virt_paid_listing`;


INSERT INTO `cpnl_settings` (`set_id`, `set_key`, `set_value`, `set_date`, `set_status`) VALUES (NULL, 'refferal_commission', '100', '2020-08-14 13:29:52', '1');

CREATE TABLE `cpnl_user_balance` (
  `ub_id` int(11) NOT NULL,
  `ub_user_id` int(11) NOT NULL,
  `ub_user_balance` double NOT NULL,
  `ub_updated_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


ALTER TABLE `cpnl_user_balance`
  ADD PRIMARY KEY (`ub_id`);
ALTER TABLE `cpnl_user_balance`
  MODIFY `ub_id` int(11) NOT NULL AUTO_INCREMENT;

  cpnl_usr_commission_details
  
  cpnl_wallet_details
  cpnl_level_commission_config

  ALTER TABLE `cpnl_products_category` ADD `pcat_virt_cat_banner` VARCHAR(100) NOT NULL AFTER `pcat_virtual_stat`;
  
  
  INSERT INTO `cpnl_settings` (`set_id`, `set_key`, `set_value`, `set_date`, `set_status`) VALUES (NULL, 'level_depth', '10', '2020-08-19 07:42:57', '1');

  ALTER TABLE `cpnl_virtshop_town_stock_assoc` ADD `vtsa_type` VARCHAR(100) NOT NULL DEFAULT 'free_listing' AFTER `vtsa_supm_id`;
  
  ALTER TABLE `cpnl_products_order_master` ADD `ordm_virtual_shop_owner` INT(11) NOT NULL AFTER `ordm_submited_srr_report`;
  ALTER TABLE `cpnl_wallet_details` ADD `cd_type` VARCHAR(100) NOT NULL COMMENT 'commission, payout, ....' AFTER `cd_amount_type`;
  
  cpnl_15_level_users
  *************************UPDATED IN LIVE *******************************************************8
  
sponser_id
----------
C:\xampp\htdocs\kleemz\application\modules\api\models\api_auth_model.php
C:\xampp\htdocs\kleemz\application\libraries\Ion_auth.php
C:\xampp\htdocs\kleemz\application\models\ion_auth_model.php
C:\xampp\htdocs\kleemz\application\modules\api\controllers\api.php

grp
---
signupVirtualPartner -->usr_sponser_id (user id of sponser)

testing
-------
refferal_commission while confirming payment from app side and order from admin side(order List)

ALTER TABLE `cpnl_products_stock_details` ADD `pdsm_gst` DOUBLE NOT NULL AFTER `pdsm_to_kleemz`;
