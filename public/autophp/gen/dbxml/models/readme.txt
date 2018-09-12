Model.xml文件说明


1. 基本方法, 即基本写数据库方法 （mode为default）
	--insert	基本插入数据
	--update	更新数据
	--delete	删除数据
	--invalidate	表中存在is_deleted字段的，加入此基本方法，表示为“逻辑删除”
	
	基本方法加入model.xml文件只需如下写法
		<action name="insert" mode="default" /> 该方法必须放在第一位
		<action name="update" mode="default" /> 
		<action name="delete" mode="default" /> 该方法必须放在最后一位
	以上三种方法为必须
		<action name="invalidate" mode="default" />
	该方法视is_deleted字段添加

	
2. 获取数据方法，即读数据库方法（mode为select, 需要有返回结果集类型：list表示多行数据；row表示单行数据；one表示单一数据）
		<action name="getListByParentId" mode="select" resultType="list">    
			<inputs>
	            <field type="variable" name="id"/>
	            <field type="keyword" name="limit" />                         
	        </inputs>
	        <outputs>
	            <field type="int" name="charter_id" />
	            <field type="text" name="name" /> 
	        </outputs>
			<query>
				SELECT `charter_id`, `name` FROM `charter` 
				WHERE `parent_id` = :id
			</query>
		</action>
	该类方法包函三段
		1. 输入参数
			type					name
		----------------------------------------
			varible					非数组参数名				
			array					数组参数名
			keyword					有三种取值：limit,orderby,groupby;需要分页，动态排序，动态分组的加入此参数
			
		2. 输出字段
			至少包含一个字段.
			type为字段类型（包含三种类型int,text,datetime）， name为字段名
			
		3. query语句
			采用索引数组写。如（`parent_id` = :id）

		
3. 自定义写数据库方法 (mode为custom)
	<action name="groupDel" mode="custom">    
		<inputs>
            <field type="variable" name="id"/>
            <field type="variable" name="route_path"/>                                
        </inputs>
        <query>
        	DELETE FROM `charter` 
        	WHERE
        	`charter_id` = :id OR 
        	LEFT(`route_path`, LENGTH(:route_path)) = :route_path
        </query>
	</action> 
	该类方法包类两段，没有输出字段。 其它与“读数据库方法”一样，
	

	
	
	
	