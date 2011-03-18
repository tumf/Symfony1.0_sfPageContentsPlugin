<?php



class SfPageContentsPageContentMapBuilder {

	
	const CLASS_NAME = 'plugins.sfPageContentsPlugin.lib.model.map.SfPageContentsPageContentMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('sf_page_contents_page_content');
		$tMap->setPhpName('SfPageContentsPageContent');

		$tMap->setUseIdGenerator(true);

		$tMap->addForeignKey('SF_PAGE_CONTENTS_PAGE_ID', 'SfPageContentsPageId', 'int', CreoleTypes::INTEGER, 'sf_page_contents_page', 'ID', false, null);

		$tMap->addForeignKey('SF_PAGE_CONTENTS_CONTENT_ID', 'SfPageContentsContentId', 'int', CreoleTypes::INTEGER, 'sf_page_contents_content', 'ID', false, null);

		$tMap->addColumn('SHOW_ORDER', 'ShowOrder', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

	} 
} 