<?php


abstract class BaseSfPageContentsPageContentPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'sf_page_contents_page_content';

	
	const CLASS_DEFAULT = 'plugins.sfPageContentsPlugin.lib.model.SfPageContentsPageContent';

	
	const NUM_COLUMNS = 4;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const SF_PAGE_CONTENTS_PAGE_ID = 'sf_page_contents_page_content.SF_PAGE_CONTENTS_PAGE_ID';

	
	const SF_PAGE_CONTENTS_CONTENT_ID = 'sf_page_contents_page_content.SF_PAGE_CONTENTS_CONTENT_ID';

	
	const SHOW_ORDER = 'sf_page_contents_page_content.SHOW_ORDER';

	
	const ID = 'sf_page_contents_page_content.ID';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('SfPageContentsPageId', 'SfPageContentsContentId', 'ShowOrder', 'Id', ),
		BasePeer::TYPE_COLNAME => array (SfPageContentsPageContentPeer::SF_PAGE_CONTENTS_PAGE_ID, SfPageContentsPageContentPeer::SF_PAGE_CONTENTS_CONTENT_ID, SfPageContentsPageContentPeer::SHOW_ORDER, SfPageContentsPageContentPeer::ID, ),
		BasePeer::TYPE_FIELDNAME => array ('sf_page_contents_page_id', 'sf_page_contents_content_id', 'show_order', 'id', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('SfPageContentsPageId' => 0, 'SfPageContentsContentId' => 1, 'ShowOrder' => 2, 'Id' => 3, ),
		BasePeer::TYPE_COLNAME => array (SfPageContentsPageContentPeer::SF_PAGE_CONTENTS_PAGE_ID => 0, SfPageContentsPageContentPeer::SF_PAGE_CONTENTS_CONTENT_ID => 1, SfPageContentsPageContentPeer::SHOW_ORDER => 2, SfPageContentsPageContentPeer::ID => 3, ),
		BasePeer::TYPE_FIELDNAME => array ('sf_page_contents_page_id' => 0, 'sf_page_contents_content_id' => 1, 'show_order' => 2, 'id' => 3, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'plugins/sfPageContentsPlugin/lib/model/map/SfPageContentsPageContentMapBuilder.php';
		return BasePeer::getMapBuilder('plugins.sfPageContentsPlugin.lib.model.map.SfPageContentsPageContentMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = SfPageContentsPageContentPeer::getTableMap();
			$columns = $map->getColumns();
			$nameMap = array();
			foreach ($columns as $column) {
				$nameMap[$column->getPhpName()] = $column->getColumnName();
			}
			self::$phpNameMap = $nameMap;
		}
		return self::$phpNameMap;
	}
	
	static public function translateFieldName($name, $fromType, $toType)
	{
		$toNames = self::getFieldNames($toType);
		$key = isset(self::$fieldKeys[$fromType][$name]) ? self::$fieldKeys[$fromType][$name] : null;
		if ($key === null) {
			throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(self::$fieldKeys[$fromType], true));
		}
		return $toNames[$key];
	}

	

	static public function getFieldNames($type = BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants TYPE_PHPNAME, TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM. ' . $type . ' was given.');
		}
		return self::$fieldNames[$type];
	}

	
	public static function alias($alias, $column)
	{
		return str_replace(SfPageContentsPageContentPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(SfPageContentsPageContentPeer::SF_PAGE_CONTENTS_PAGE_ID);

		$criteria->addSelectColumn(SfPageContentsPageContentPeer::SF_PAGE_CONTENTS_CONTENT_ID);

		$criteria->addSelectColumn(SfPageContentsPageContentPeer::SHOW_ORDER);

		$criteria->addSelectColumn(SfPageContentsPageContentPeer::ID);

	}

	const COUNT = 'COUNT(sf_page_contents_page_content.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT sf_page_contents_page_content.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SfPageContentsPageContentPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SfPageContentsPageContentPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = SfPageContentsPageContentPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}
	
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = SfPageContentsPageContentPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return SfPageContentsPageContentPeer::populateObjects(SfPageContentsPageContentPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			SfPageContentsPageContentPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = SfPageContentsPageContentPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinSfPageContentsPage(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SfPageContentsPageContentPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SfPageContentsPageContentPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SfPageContentsPageContentPeer::SF_PAGE_CONTENTS_PAGE_ID, SfPageContentsPagePeer::ID);

		$rs = SfPageContentsPageContentPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinSfPageContentsContent(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SfPageContentsPageContentPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SfPageContentsPageContentPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SfPageContentsPageContentPeer::SF_PAGE_CONTENTS_CONTENT_ID, SfPageContentsContentPeer::ID);

		$rs = SfPageContentsPageContentPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinSfPageContentsPage(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		SfPageContentsPageContentPeer::addSelectColumns($c);
		$startcol = (SfPageContentsPageContentPeer::NUM_COLUMNS - SfPageContentsPageContentPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		SfPageContentsPagePeer::addSelectColumns($c);

		$c->addJoin(SfPageContentsPageContentPeer::SF_PAGE_CONTENTS_PAGE_ID, SfPageContentsPagePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SfPageContentsPageContentPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = SfPageContentsPagePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getSfPageContentsPage(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addSfPageContentsPageContent($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initSfPageContentsPageContents();
				$obj2->addSfPageContentsPageContent($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinSfPageContentsContent(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		SfPageContentsPageContentPeer::addSelectColumns($c);
		$startcol = (SfPageContentsPageContentPeer::NUM_COLUMNS - SfPageContentsPageContentPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		SfPageContentsContentPeer::addSelectColumns($c);

		$c->addJoin(SfPageContentsPageContentPeer::SF_PAGE_CONTENTS_CONTENT_ID, SfPageContentsContentPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SfPageContentsPageContentPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = SfPageContentsContentPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getSfPageContentsContent(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addSfPageContentsPageContent($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initSfPageContentsPageContents();
				$obj2->addSfPageContentsPageContent($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SfPageContentsPageContentPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SfPageContentsPageContentPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SfPageContentsPageContentPeer::SF_PAGE_CONTENTS_PAGE_ID, SfPageContentsPagePeer::ID);

		$criteria->addJoin(SfPageContentsPageContentPeer::SF_PAGE_CONTENTS_CONTENT_ID, SfPageContentsContentPeer::ID);

		$rs = SfPageContentsPageContentPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAll(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		SfPageContentsPageContentPeer::addSelectColumns($c);
		$startcol2 = (SfPageContentsPageContentPeer::NUM_COLUMNS - SfPageContentsPageContentPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		SfPageContentsPagePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + SfPageContentsPagePeer::NUM_COLUMNS;

		SfPageContentsContentPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + SfPageContentsContentPeer::NUM_COLUMNS;

		$c->addJoin(SfPageContentsPageContentPeer::SF_PAGE_CONTENTS_PAGE_ID, SfPageContentsPagePeer::ID);

		$c->addJoin(SfPageContentsPageContentPeer::SF_PAGE_CONTENTS_CONTENT_ID, SfPageContentsContentPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SfPageContentsPageContentPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = SfPageContentsPagePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getSfPageContentsPage(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addSfPageContentsPageContent($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initSfPageContentsPageContents();
				$obj2->addSfPageContentsPageContent($obj1);
			}


					
			$omClass = SfPageContentsContentPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getSfPageContentsContent(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addSfPageContentsPageContent($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initSfPageContentsPageContents();
				$obj3->addSfPageContentsPageContent($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptSfPageContentsPage(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SfPageContentsPageContentPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SfPageContentsPageContentPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SfPageContentsPageContentPeer::SF_PAGE_CONTENTS_CONTENT_ID, SfPageContentsContentPeer::ID);

		$rs = SfPageContentsPageContentPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptSfPageContentsContent(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SfPageContentsPageContentPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SfPageContentsPageContentPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SfPageContentsPageContentPeer::SF_PAGE_CONTENTS_PAGE_ID, SfPageContentsPagePeer::ID);

		$rs = SfPageContentsPageContentPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptSfPageContentsPage(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		SfPageContentsPageContentPeer::addSelectColumns($c);
		$startcol2 = (SfPageContentsPageContentPeer::NUM_COLUMNS - SfPageContentsPageContentPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		SfPageContentsContentPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + SfPageContentsContentPeer::NUM_COLUMNS;

		$c->addJoin(SfPageContentsPageContentPeer::SF_PAGE_CONTENTS_CONTENT_ID, SfPageContentsContentPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SfPageContentsPageContentPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = SfPageContentsContentPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getSfPageContentsContent(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addSfPageContentsPageContent($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initSfPageContentsPageContents();
				$obj2->addSfPageContentsPageContent($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptSfPageContentsContent(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		SfPageContentsPageContentPeer::addSelectColumns($c);
		$startcol2 = (SfPageContentsPageContentPeer::NUM_COLUMNS - SfPageContentsPageContentPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		SfPageContentsPagePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + SfPageContentsPagePeer::NUM_COLUMNS;

		$c->addJoin(SfPageContentsPageContentPeer::SF_PAGE_CONTENTS_PAGE_ID, SfPageContentsPagePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SfPageContentsPageContentPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = SfPageContentsPagePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getSfPageContentsPage(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addSfPageContentsPageContent($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initSfPageContentsPageContents();
				$obj2->addSfPageContentsPageContent($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}

	
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	
	public static function getOMClass()
	{
		return SfPageContentsPageContentPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(SfPageContentsPageContentPeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(SfPageContentsPageContentPeer::ID);
			$selectCriteria->add(SfPageContentsPageContentPeer::ID, $criteria->remove(SfPageContentsPageContentPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$affectedRows = 0; 		try {
									$con->begin();
			$affectedRows += BasePeer::doDeleteAll(SfPageContentsPageContentPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	 public static function doDelete($values, $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(SfPageContentsPageContentPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof SfPageContentsPageContent) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(SfPageContentsPageContentPeer::ID, (array) $values, Criteria::IN);
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->begin();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public static function doValidate(SfPageContentsPageContent $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(SfPageContentsPageContentPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(SfPageContentsPageContentPeer::TABLE_NAME);

			if (! is_array($cols)) {
				$cols = array($cols);
			}

			foreach($cols as $colName) {
				if ($tableMap->containsColumn($colName)) {
					$get = 'get' . $tableMap->getColumn($colName)->getPhpName();
					$columns[$colName] = $obj->$get();
				}
			}
		} else {

		}

		$res =  BasePeer::doValidate(SfPageContentsPageContentPeer::DATABASE_NAME, SfPageContentsPageContentPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = SfPageContentsPageContentPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(SfPageContentsPageContentPeer::DATABASE_NAME);

		$criteria->add(SfPageContentsPageContentPeer::ID, $pk);


		$v = SfPageContentsPageContentPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria();
			$criteria->add(SfPageContentsPageContentPeer::ID, $pks, Criteria::IN);
			$objs = SfPageContentsPageContentPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseSfPageContentsPageContentPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'plugins/sfPageContentsPlugin/lib/model/map/SfPageContentsPageContentMapBuilder.php';
	Propel::registerMapBuilder('plugins.sfPageContentsPlugin.lib.model.map.SfPageContentsPageContentMapBuilder');
}
