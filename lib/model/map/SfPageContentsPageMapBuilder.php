<?php



class SfPageContentsPageMapBuilder {

	
	const CLASS_NAME = 'plugins.sfPageContentsPlugin.lib.model.map.SfPageContentsPageMapBuilder';

	
	private $dbMap;

	
	public function isBuilt()
	{
		return ($this->dbMap !== null);
	}

	
	public function getDatabaseMap()
	{
		return $this->dbMap;
	}

	
	public function doBuild()
	{
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('sf_page_contents_page');
		$tMap->setPhpName('SfPageContentsPage');

		$tMap->setUseIdGenerator(true);

		$tMap->addColumn('NAME', 'Name', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('TITLE', 'Title', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('KEYWORDS', 'Keywords', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('DESCRIPTION', 'Description', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('URL', 'Url', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('LAYOUT', 'Layout', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('IS_PUBLIC', 'IsPublic', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('BODY', 'Body', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('MODUL', 'Modul', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('ACTION', 'Action', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('RELEASE_BEGIN', 'ReleaseBegin', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('RELEASE_END', 'ReleaseEnd', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

	} 
} 