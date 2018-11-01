
ALTER TABLE `h5_gm_pt_appid_relation`
  ADD CONSTRAINT `fk_game_id` FOREIGN KEY (`game_id`) REFERENCES `h5_cp_game` (`game_id`);
			  
ALTER TABLE `h5_gm_pt_appid_relation`
  ADD CONSTRAINT `fk_platform_id` FOREIGN KEY (`platform_id`) REFERENCES `h5_yun_platform` (`platform_id`);
			  
ALTER TABLE `h5_gm_pt_relation`
  ADD CONSTRAINT `fk_game_id` FOREIGN KEY (`game_id`) REFERENCES `h5_cp_game` (`game_id`);
			  
ALTER TABLE `h5_gm_pt_relation`
  ADD CONSTRAINT `fk_platform_id` FOREIGN KEY (`platform_id`) REFERENCES `h5_yun_platform` (`platform_id`);
			  
ALTER TABLE `h5_yun_active`
  ADD CONSTRAINT `fk_game_id` FOREIGN KEY (`game_id`) REFERENCES `h5_cp_game` (`game_id`);
			  
ALTER TABLE `h5_yun_active`
  ADD CONSTRAINT `fk_platform_id` FOREIGN KEY (`platform_id`) REFERENCES `h5_yun_platform` (`platform_id`);
			  
ALTER TABLE `h5_yun_login_log`
  ADD CONSTRAINT `fk_game_id` FOREIGN KEY (`game_id`) REFERENCES `h5_cp_game` (`game_id`);
			  
ALTER TABLE `h5_yun_login_log`
  ADD CONSTRAINT `fk_platform_id` FOREIGN KEY (`platform_id`) REFERENCES `h5_yun_platform` (`platform_id`);
			  
ALTER TABLE `h5_yun_order`
  ADD CONSTRAINT `fk_game_id` FOREIGN KEY (`game_id`) REFERENCES `h5_cp_game` (`game_id`);
			  
ALTER TABLE `h5_yun_order`
  ADD CONSTRAINT `fk_platform_id` FOREIGN KEY (`platform_id`) REFERENCES `h5_yun_platform` (`platform_id`);
			  
ALTER TABLE `h5_yun_share_log`
  ADD CONSTRAINT `fk_game_id` FOREIGN KEY (`game_id`) REFERENCES `h5_cp_game` (`game_id`);
			  
ALTER TABLE `h5_yun_share_log`
  ADD CONSTRAINT `fk_platform_id` FOREIGN KEY (`platform_id`) REFERENCES `h5_yun_platform` (`platform_id`);
			  
ALTER TABLE `h5_yun_user`
  ADD CONSTRAINT `fk_platform_id` FOREIGN KEY (`platform_id`) REFERENCES `h5_yun_platform` (`platform_id`);
			  
ALTER TABLE `h5_yun_user_ad`
  ADD CONSTRAINT `fk_game_id` FOREIGN KEY (`game_id`) REFERENCES `h5_cp_game` (`game_id`);
			  
ALTER TABLE `h5_yun_user_ad`
  ADD CONSTRAINT `fk_platform_id` FOREIGN KEY (`platform_id`) REFERENCES `h5_yun_platform` (`platform_id`);
			  
ALTER TABLE `h5_yun_user_log`
  ADD CONSTRAINT `fk_game_id` FOREIGN KEY (`game_id`) REFERENCES `h5_cp_game` (`game_id`);
			  
ALTER TABLE `h5_yun_user_log`
  ADD CONSTRAINT `fk_platform_id` FOREIGN KEY (`platform_id`) REFERENCES `h5_yun_platform` (`platform_id`);
			  
ALTER TABLE `h5_yun_user_log`
  ADD CONSTRAINT `fk_game_id` FOREIGN KEY (`game_id`) REFERENCES `h5_cp_game` (`game_id`);
			  
ALTER TABLE `h5_yun_user_log`
  ADD CONSTRAINT `fk_platform_id` FOREIGN KEY (`platform_id`) REFERENCES `h5_yun_platform` (`platform_id`);
			  
ALTER TABLE `h5_yun_xcx_user_session`
  ADD CONSTRAINT `fk_game_id` FOREIGN KEY (`game_id`) REFERENCES `h5_cp_game` (`game_id`);
			  
ALTER TABLE `h5_yun_xcx_user_session`
  ADD CONSTRAINT `fk_platform_id` FOREIGN KEY (`platform_id`) REFERENCES `h5_yun_platform` (`platform_id`);
			  
ALTER TABLE `power_user`
  ADD CONSTRAINT `fk_user_role` FOREIGN KEY (`power_role_id`) REFERENCES `power_role` (`power_role_id`);
			  