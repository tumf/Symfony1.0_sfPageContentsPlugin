<?php


abstract class BaseSfPageContentsPagePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'sf_page_contents_page';

	
	const CLASS_DEFAULT = 'plugins.sfPageContentsPlugin.lib.model.SfPageContentsPage';

	
	const NUM_COLUMNS = 15;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const NAME = 'sf_page_contents_page.NAME';

	
	const TITLE = 'sf_page_contents_page.TITLE';

	
	const KEYWORDS = 'sf_page_contents_page.KEYWORDS';

	
	const DESCRIPTION = 'sf_page_contents_page.DESCRIPTION';

	
	const URL = 'sf_page_contents_page.URL';

	
	const LAYOUT = 'sf_page_contents_page.LAYOUT';

	
	const IS_PUBLIC = 'sf_page_contents_page.IS_PUBLIC';

	
	const BODY = 'sf_page_contents_page.BODY';

	
	const MODUL = 'sf_page_contents_page.MODUL';

	
	const ACTION = 'sf_page_contents_page.ACTION';

	
	const RELEASE_BEGIN = 'sf_page_contents_page.RELEASE_BEGIN';

	
	const RELEASE_END = 'sf_page_contents_page.RELEASE_END';

	
	const CREATED_AT = 'sf_page_contents_page.CREATED_AT';

	
	const UPDATED_AT = 'sf_page_contents_page.UPDATED_AT';

	
	const ID = 'sf_page_contents_page.ID';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Name', 'Title', 'Keywords', 'Description', 'Url', 'Layout', 'IsPublic', 'Body', 'Modul', 'Action', 'ReleaseBegin', 'ReleaseEnd', 'CreatedAt', 'UpdatedAt', 'Id', ),
		BasePeer::TYPE_COLNAME => array (SfPageContentsPagePeer::NAME, SfPageContentsPagePeer::TITLE, SfPageContentsPagePeer::KEYWORDS, SfPageContentsPagePeer::DESCRIPTION, SfPageContentsPagePeer::URL, SfPageContentsPagePeer::LAYOUT, SfPageContentsPagePeer::IS_PUBLIC, SfPageContentsPagePeer::BODY, SfPageContentsPagePeer::MODUL, SfPageContentsPagePeer::ACTION, SfPageContentsPagePeer::RELEASE_BEGIN, SfPageContentsPagePeer::RELEASE_END, SfPageContentsPagePeer::CREATED_AT, SfPageContentsPagePeer::UPDATED_AT, SfPageContentsPagePeer::ID, ),
		BasePeer::TYPE_FIELDNAME => array ('name', 'title', 'keywords', 'description', 'url', 'layout', 'is_public', 'body', 'modul', 'action', 'release_begin', 'release_end', 'created_at', 'updated_at', 'id', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Name' => 0, 'Title' => 1, 'Keywords' => 2, 'Description' => 3, 'Url' => 4, 'Layout' => 5, 'IsPublic' => 6, 'Body' => 7, 'Modul' => 8, 'Action' => 9, 'ReleaseBegin' => 10, 'ReleaseEnd' => 11, 'CreatedAt' => 12, 'UpdatedAt' => 13, 'Id' => 14, ),
		BasePeer::TYPE_COLNAME => array (SfPageContentsPagePeer::NAME => 0, SfPageContentsPagePeer::TITLE => 1, SfPageContentsPagePeer::KEYWORDS => 2, SfPageContentsPagePeer::DESCRIPTION => 3, SfPageContentsPagePeer::URL => 4, SfPageContentsPagePeer::LAYOUT => 5, SfPageContentsPagePeer::IS_PUBLIC => 6, SfPageContentsPagePeer::BODY => 7, SfPageContentsPagePeer::MODUL => 8, SfPageContentsPagePeer::ACTION => 9, SfPageContentsPagePeer::RELEASE_BEGIN => 10, SfPageContentsPagePeer::RELEASE_END => 11, SfPageContentsPagePeer::CREATED_AT => 12, SfPageContentsPagePeer::UPDATED_AT => 13, SfPageContentsPagePeer::ID => 14, ),
		BasePeer::TYPE_FIELDNAME => array ('name' => 0, 'title' => 1, 'keywords' => 2, 'description' => 3, 'url' => 4, 'layout' => 5, 'is_public' => 6, 'body' => 7, 'modul' => 8, 'action' => 9, 'release_begin' => 10, 'release_end' => 11, 'created_at' => 12, 'updated_at' => 13, 'id' => 14, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'plugins/sfPageContentsPlugin/lib/model/map/SfPageContentsPageMapBuilder.php';
		return BasePeer::getMapBuilder('plugins.sfPageContentsPlugin.lib.model.map.SfPageContentsPageMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = SfPageContentsPagePeer::getTableMap();
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
		return str_replace(SfPageContentsPagePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(SfPageContentsPagePeer::NAME);

		$criteria->addSelectColumn(SfPageContentsPagePeer::TITLE);

		$criteria->addSelectColumn(SfPageContentsPagePeer::KEYWORDS);

		$criteria->addSelectColumn(SfPageContentsPagePeer::DESCRIPTION);

		$criteria->addSelectColumn(SfPageContentsPagePeer::URL);

		$criteria->addSelectColumn(SfPageContentsPagePeer::LAYOUT);

		$criteria->addSelectColumn(SfPageContentsPagePeer::IS_PUBLIC);

		$criteria->addSelectColumn(SfPageContentsPagePeer::BODY);

		$criteria->addSelectColumn(SfPageContentsPagePeer::MODUL);

		$criteria->addSelectColumn(SfPageContentsPagePeer::ACTION);

		$criteria->addSelectColumn(SfPageContentsPagePeer::RELEASE_BEGIN);

		$criteria->addSelectColumn(SfPageContentsPagePeer::RELEASE_END);

		$criteria->addSelectColumn(SfPageContentsPagePeer::CREATED_AT);

		$criteria->addSelectColumn(SfPageContentsPagePeer::UPDATED_AT);

		$criteria->addSelectColumn(SfPageContentsPagePeer::ID);

	}

	const COUNT = 'COUNT(sf_page_contents_page.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT sf_page_contents_page.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SfPageContentsPagePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SfPageContentsPagePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = SfPageContentsPagePeer::doSelectRS($criteria, $con);
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
		$objects = SfPageContentsPagePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return SfPageContentsPagePeer::populateObjects(SfPageContentsPagePeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			SfPageContentsPagePeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = SfPageContentsPagePeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}
	
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	
	public static function getOMClass()
	{
		return SfPageContentsPagePeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(SfPageContentsPagePeer::ID); 

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
			$comparison = $criteria->getComparison(SfPageContentsPagePeer::ID);
			$selectCriteria->add(SfPageContentsPagePeer::ID, $criteria->remove(SfPageContentsPagePeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(SfPageContentsPagePeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(SfPageContentsPagePeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof SfPageContentsPage) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(SfPageContentsPagePeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(SfPageContentsPage $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(SfPageContentsPagePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(SfPageContentsPagePeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(SfPageContentsPagePeer::DATABASE_NAME, SfPageContentsPagePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = SfPageContentsPagePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(SfPageContentsPagePeer::DATABASE_NAME);

		$criteria->add(SfPageContentsPagePeer::ID, $pk);


		$v = SfPageContentsPagePeer::doSelect($criteria, $con);

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
			$criteria->add(SfPageContentsPagePeer::ID, $pks, Criteria::IN);
			$objs = SfPageContentsPagePeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseSfPageContentsPagePeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'plugins/sfPageContentsPlugin/lib/model/map/SfPageContentsPageMapBuilder.php';
	Propel::registerMapBuilder('plugins.sfPageContentsPlugin.lib.model.map.SfPageContentsPageMapBuilder');
}
