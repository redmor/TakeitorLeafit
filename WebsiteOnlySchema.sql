
#
# TABLE STRUCTURE FOR: customer
#

DROP TABLE IF EXISTS `customer`;

CREATE TABLE `customer` (
  `acct_num` int(15) unsigned NOT NULL AUTO_INCREMENT UNIQUE  COMMENT 'their account # is unique',
  `first_name` varchar(100) NOT NULL ,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL UNIQUE  COMMENT 'used as login',
  `street` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(2) NOT NULL,
  `zip` int(9) unsigned NOT NULL,
  `password` varchar(60) NOT NULL  COMMENT 'hashed by website',
  `date_reg` timestamp NOT NULL DEFAULT current_timestamp(),
  `default_store` enum('1000-Col','1001-Col','2000-Pitt','2001-Pitt','3000-Det','3001-Det','4000-Indy','4001-Indy','Not Set') NOT NULL DEFAULT 'Not Set'  COMMENT 'Needs to be set before ordering',
  PRIMARY KEY (`acct_num`)
) ;


#
# TABLE STRUCTURE FOR: items
#

DROP TABLE IF EXISTS `items`;

CREATE TABLE `items` (
  `item_id` int(15) unsigned NOT NULL AUTO_INCREMENT UNIQUE  COMMENT 'internal id, has no purpose other than primary key / foreign key',
  `item` enum('flower','arrangement','gift','other') NOT NULL DEFAULT 'Other'  COMMENT 'Type: such as Flower, Gift',
  `item_name` varchar(150) NOT NULL  COMMENT 'such as Japanese Silver Rose',
  `desc` text NOT NULL  COMMENT 'Full description of item',
  `purchase_cost` decimal(10,2) unsigned NOT NULL,
  `sell_cost` decimal(10,2) unsigned NOT NULL,
  `category` enum('anniversary', 'marriage', 'graduation', 'teddy bears', 'chocolate', 'other') NOT NULL DEFAULT 'Other',
  `img` varchar(50) NOT NULL  COMMENT 'the name of the image file on the webserver',
  `featured` int(1) unsigned NOT NULL DEFAULT '1' COMMENT 'a flag for featuring items at the top of the list',
  PRIMARY KEY (`item_id`)
) ;

#
# TABLE STRUCTURE FOR: order_history
#

DROP TABLE IF EXISTS `order_history`;

CREATE TABLE `order_history` (
  `order_num` int(32) unsigned NOT NULL AUTO_INCREMENT UNIQUE  COMMENT 'order number, not to be confused with Invoice number (for accounts rec) but can be used as such for non business accounts',
  `acct_num` int(15) unsigned NOT NULL  COMMENT 'fkey, references to customer whose order this is',
  `del_addy` text NOT NULL  COMMENT 'the address in plain text',
  `total` decimal(10,2) unsigned NOT NULL  COMMENT 'generated website side or app side as needed',
  `pay_rec` enum('Paid','Not Paid') NOT NULL DEFAULT 'Paid'  COMMENT ' NOT FOR WEBSITE: should only be Not Paid for Invoiced orders, otherwise not to be used at this time', 
  `trans_date` timestamp NOT NULL DEFAULT current_timestamp()  COMMENT 'date the order was placed',
  `del_date` timestamp NULL DEFAULT NULL  COMMENT 'date the order is to be delivered',
  `pay_type` enum('Credit Card','Cash','CoD','Check','Invoice') NOT NULL DEFAULT 'Credit Card' COMMENT 'Website ONLY uses Credit Card - all other are future proofing/acct_rec',
  `order_status` enum('Ordered','Received','Processed','Out For Delivery','Delivered','Canceled') NOT NULL DEFAULT 'Ordered' COMMENT 'Defaults to Ordered, WEBSITE DOES NOT USE ANY OTHER OPTION',
  `location` enum('1000-Col','1001-Col','2000-Pitt','2001-Pitt','3000-Det','3001-Det','4000-Indy','4001-Indy') NOT NULL DEFAULT '1000-Col',
  `emp_num` int(15) unsigned NOT NULL COMMENT 'NOT FOR WEBSITE: the employee currently working on (or who worked on) the order Default it to 0 (not assigned).',
  PRIMARY KEY(`order_num`),
  CONSTRAINT acct_num_idfk_1  FOREIGN KEY (acct_num) REFERENCES customer (acct_num)
) ;

#
# TABLE STRUCTURE FOR: order_items
#

DROP TABLE IF EXISTS `order_items`;

CREATE TABLE `order_items` (
  `id` bigint(150) unsigned NOT NULL AUTO_INCREMENT UNIQUE  COMMENT 'internal only, not to be used in any other form - as there will be many line items per order, this is bigInt to make sure we dont run out of incremental numbers',
  `order_num` int(15) unsigned NOT NULL  COMMENT 'fkey, reference to the order in order_history with delivery date, total, ect', 
  `item_id` int(15) unsigned NOT NULL  COMMENT 'fkey - individual line item - the item for this line of the order', 
  `item_price` decimal(10,2) unsigned NOT NULL  COMMENT 'added server side, pulled from items table',
  `qty` int(4) unsigned NOT NULL COMMENT 'qty of this line item of the order',
  PRIMARY KEY(`id`),
  CONSTRAINT order_num_idfk_1 FOREIGN KEY (order_num) REFERENCES order_history (order_num),
  CONSTRAINT item_id_idfk_1 FOREIGN KEY (item_id) REFERENCES items (item_id)
);
