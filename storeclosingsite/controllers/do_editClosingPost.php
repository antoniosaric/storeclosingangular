editPost.php

SELECT DISTINCT image.imageName, activity.activity, activity.id AS activityId, period.start AS periodStart, period.end AS periodEnd, team.id as teamid, team.locale, team.name, location.city, location.stateProvince, location.country, profile_franchise_sm_activity_role_sm.id AS profile_franchise_sm_activity_role_smId, profile_franchise_sm_activity_role_sm.id AS roleId, activity_role.role AS role  FROM image FULL JOIN activity_image_sm ON image.id=activity_image_sm.imageId AND imageTypeId=3 FULL JOIN activity ON activity.id=activity_image_sm.activityId FULL JOIN entity_activity_sm ON entity_activity_sm.activityId=activity.id FULL JOIN entity_activity_sm_partition_sm ON entity_activity_sm.id=entity_activity_sm_partition_sm.entityActivitySmId FULL JOIN team ON team.entityActivitySmPartitionSmId=entity_activity_sm_partition_sm.id FULL JOIN team_location_sm ON team.id=team_location_sm.teamId FULL JOIN location ON team_location_sm.locationId=location.id FULL JOIN franchise_team_sm ON team.id=franchise_team_sm.teamId FULL JOIN profile_franchise_sm ON franchise_team_sm.franchiseId=profile_franchise_sm.franchiseId FULL JOIN profile ON profile_franchise_sm.profileId=profile.id FULL JOIN profile_team_sm ON team.id= profile_team_sm.teamId FULL JOIN profile_team_sm_period_sm ON profile_team_sm_period_sm.profileTeamSmId = profile_team_sm.id FULL JOIN period ON profile_team_sm_period_sm.periodId = period.id FULL JOIN profile_franchise_sm_activity_role_sm ON profile_franchise_sm_activity_role_sm.profileFranchiseSmId =profile_franchise_sm.id FULL JOIN activity_role ON activity_role.id = profile_franchise_sm_activity_role_sm.activityRoleId FULL JOIN profile_activity_sm ON profile_activity_sm.activityId=activity_image_sm.activityId WHERE profile.id=? ORDER BY activity.activity

SELECT DISTINCT image.imageName, activity.activity, activity.id AS activityId FROM activity FULL JOIN activity_image_sm ON activity.id=activity_image_sm.activityId FULL JOIN image ON activity_image_sm.imageId=image.id AND imageTypeId=3 FULL JOIN profile_activity_sm ON profile_activity_sm.activityId=activity_image_sm.activityId FULL JOIN profile ON profile_activity_sm.profileId=profile.id WHERE profile.id=? ORDER BY activity.activity

SELECT DISTINCT image.imageName, activity.activity, activity.id AS activityId, period.start AS periodStart, period.end AS periodEnd, team.id as teamid, team.locale, team.name, location.city, location.stateProvince, location.country, profile_franchise_sm_activity_role_sm.id AS profile_franchise_sm_activity_role_smId, profile_franchise_sm_activity_role_sm.id AS roleId, activity_role.role AS role FROM image 
FULL JOIN activity_image_sm ON image.id=activity_image_sm.imageId 
FULL JOIN activity ON activity.id=activity_image_sm.activityId 
FULL JOIN entity_activity_sm ON entity_activity_sm.activityId=activity.id 
FULL JOIN entity_activity_sm_partition_sm ON entity_activity_sm.id=entity_activity_sm_partition_sm.entityActivitySmId 
FULL JOIN team ON team.entityActivitySmPartitionSmId=entity_activity_sm_partition_sm.id 
FULL JOIN team_location_sm ON team.id=team_location_sm.teamId 
FULL JOIN location ON team_location_sm.locationId=location.id 
FULL JOIN franchise_team_sm ON team.id=franchise_team_sm.teamId 
FULL JOIN profile_franchise_sm ON franchise_team_sm.franchiseId=profile_franchise_sm.franchiseId 
FULL JOIN profile ON profile_franchise_sm.profileId=profile.id 
FULL JOIN profile_team_sm ON team.id= profile_team_sm.teamId 
FULL JOIN profile_team_sm_period_sm ON profile_team_sm_period_sm.profileTeamSmId = profile_team_sm.id 
FULL JOIN period ON profile_team_sm_period_sm.periodId = period.id 
FULL JOIN profile_franchise_sm_activity_role_sm ON profile_franchise_sm_activity_role_sm.profileFranchiseSmId =profile_franchise_sm.id 
FULL JOIN activity_role ON activity_role.id = profile_franchise_sm_activity_role_sm.activityRoleId 
FULL JOIN profile_activity_sm ON profile_activity_sm.activityId=activity_image_sm.activityId WHERE profile.id=691 AND image.imageTypeId=3 ORDER BY activity.activity