DROP TABLE `links`;

CREATE TABLE `links` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `url` VARCHAR( 2048 ) NOT NULL,
  `description` VARCHAR( 2047 ),
  PRIMARY KEY ( `id` ) 
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

INSERT INTO `users` (`id`, `username`, `password`, `name`) VALUES
(23, 'bens', '6718bd4113184034b769dab2b86e23debd282339', 'Thomas Bensler');

-- DROP TABLE link_tag_xrefs, tags;

CREATE TABLE `tags` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR( 127 ) NOT NULL,
  `description` VARCHAR( 2047 ),
  `parent_id` INT UNSIGNED NULL,
  PRIMARY KEY ( `id` ) 
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

ALTER TABLE `tags`
  ADD CONSTRAINT `fk_tag__parent_tag` FOREIGN KEY (`parent_id`) REFERENCES `tags` (`id`);

INSERT INTO `tags` (`id` ,`name` ,`description` ,`parent_id`) VALUES 
  (1 , 'new', 'kinda inbox', NULL), 
  (2 , 'media', '', NULL), 
  (3 , 'video', '', 2);

CREATE TABLE `link_tag_xrefs` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `link_id` INT UNSIGNED NOT NULL,
  `tag_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY ( `id` ) 
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

ALTER TABLE `link_tag_xrefs`
  ADD CONSTRAINT `fk_link_tag_xrefs__tags` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_link_tag_xrefs__links` FOREIGN KEY (`link_id`) REFERENCES `links` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `unique_link_tag` UNIQUE (`tag_id`, `link_id`);
  
INSERT INTO `link_tag_xrefs` (`id` ,`link_id` ,`tag_id`) VALUES
  (NULL , '111', '3');

