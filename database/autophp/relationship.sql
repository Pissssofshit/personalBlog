
ALTER TABLE `power_user`
  ADD CONSTRAINT `fk_user_role` FOREIGN KEY (`power_role_id`) REFERENCES `power_role` (`power_role_id`);
			  