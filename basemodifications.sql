 CREATE TABLE `psv`.`ola_compta` (
  `type` VARCHAR(20) NOT NULL,
  `year` INT NOT NULL,
  `month` INT NOT NULL,
  `user` VARCHAR(50) NOT NULL,
  `duration` INT NOT NULL,
  `km` INT NOT NULL,
  `extraCost` INT NOT NULL,
  PRIMARY KEY (`type`,`year`, `month`, `user`));
  
 CREATE TABLE `psv`.`ola_criad` (
  `user` VARCHAR(50) NOT NULL,
  `year` INT NOT NULL,
  `month` INT NOT NULL,
  `duration` INT NOT NULL,
  PRIMARY KEY (`user`, `year`, `month`));
  
 CREATE TABLE `psv`.`ola_prospreh` (
  `user` VARCHAR(50) NOT NULL,
  `year` INT NOT NULL,
  `month` INT NOT NULL,
  `prestGroupId` INT NOT NULL,
  `prest` INT NOT NULL,
  `duration` INT NOT NULL,
  PRIMARY KEY (`user`, `prest`, `year`, `month`));
  
-- ==============================================================================  
CREATE PROCEDURE `ola_compta_refresh` ()
BEGIN
-- clean content
	delete from ola_compta;
  
 -- insert criad elements
	insert into ola_compta
		select
			'direct' as `type`,
			YEAR(intreventions.`date`) as `year`,
			MONTH(intreventions.`date`) as `month`,
			users.username as `user`,
			sum(intreventions.duration) as `duration`,
			sum(intreventions.distance) as `km`,
			sum(intreventions.extraCost) as `extraCost`
		
		FROM intreventions
		join users
			on intreventions.intervenant_id = users.id
		group by `year`,`month`,`user`;
        
 -- insert protpreh as owner elements
	insert into ola_compta
		SELECT 
			'indirect-owner' as `type`,
			YEAR(indirect.`date`) as `year`,
			MONTH(indirect.`date`) as `month`,
			users.username as `user`,
			sum(indirect_has_prestations.duration) as `duration`,
			sum(indirect.distance) as `km`,
			sum(indirect.extraCost) as `extraCost`
		FROM
			indirect
			join indirect_has_prestations
				on indirect.id_indirect = indirect_has_prestations.indirect_id
			join users
				on indirect.owner = users.id
			group by `year`,`month`,`user`;
	
 -- insert protpreh as no-owmer elements
	insert into ola_compta
		SELECT 
			'indirect-present' as `type`,
			YEAR(indirect.`date`) as `year`,
			MONTH(indirect.`date`) as `month`,
			users.username as `user`,
			sum(indirect_has_prestations.duration) as `duration`,
			0 as `km`,
			0 as `extraCost`
		FROM
			indirect
			join indirect_has_prestations
				on indirect.id_indirect = indirect_has_prestations.indirect_id
			join indirect_has_called
				on indirect.id_indirect = indirect_has_called.indirect_id
			join users
				on indirect_has_called.user_id = users.id

		group by `year`,`month`,`user`;
END

CREATE PROCEDURE `ola_criad_refresh` ()
BEGIN
  delete from ola_criad;
 
  insert into ola_criad
	select
		users.username as `user`,
		YEAR(intreventions.`date`) as `year`,
		MONTH(intreventions.`date`) as `month`,
		sum(intreventions.duration) as `duration`
    
	FROM intreventions
		join users
			on intreventions.intervenant_id = users.id
	group by `year`,`month`,`user`;
END

CREATE PROCEDURE `ola_prospreh_refresh` ()
BEGIN
delete from ola_prospreh;
insert into ola_prospreh
	SELECT 
		users.username as `user`,
		YEAR(indirect.`date`) as `year`,
		MONTH(indirect.`date`) as `month`,
		`prestation-group`.id_presstationGroup as `prestGroupId`,
		indirect_has_prestations.prestation_id as `prest`,
		sum(indirect_has_prestations.duration) as `duration`
	FROM
		indirect
		join indirect_has_prestations
			on indirect.id_indirect = indirect_has_prestations.indirect_id
		join prestation
			on indirect_has_prestations.prestation_id = prestation.id_prestation
		join `prestation-group`
			on `prestation-group`.id_presstationGroup = prestation.prestation_group
		join users
			on indirect.owner = users.id
	group by `year`,`month`,`user`,`prest`
	UNION
    SELECT
		users.username as `user`,
		YEAR(indirect.`date`) as `year`,
		MONTH(indirect.`date`) as `month`,
		`prestation-group`.id_presstationGroup as `prestGroupId`,
		indirect_has_prestations.prestation_id as `prest`,
		sum(indirect_has_prestations.duration) as `duration`
	FROM
		indirect
		join indirect_has_prestations
			on indirect.id_indirect = indirect_has_prestations.indirect_id
		join prestation
			on indirect_has_prestations.prestation_id = prestation.id_prestation
		join `prestation-group`
			on `prestation-group`.id_presstationGroup = prestation.prestation_group
		join indirect_has_called
			on indirect.id_indirect = indirect_has_called.indirect_id
		join users
			on indirect_has_called.user_id = users.id
            
	group by `year`,`month`,`user`,`prest`;
END