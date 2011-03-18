<?php


abstract class BaseSfPageContentsPageContent extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $sf_page_contents_page_id;


	
	protected $sf_page_contents_content_id;


	
	protected $show_order = 1;


	
	protected $id;

	
	protected $aSfPageContentsPage;

	
	protected $aSfPageContentsContent;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getSfPageContentsPageId()
	{

		return $this->sf_page_contents_page_id;
	}

	
	public function getSfPageContentsContentId()
	{

		return $this->sf_page_contents_content_id;
	}

	
	public function getShowOrder()
	{

		return $this->show_order;
	}

	
	public function getId()
	{

		return $this->id;
	}

	
	public function setSfPageContentsPageId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->sf_page_contents_page_id !== $v) {
			$this->sf_page_contents_page_id = $v;
			$this->modifiedColumns[] = SfPageContentsPageContentPeer::SF_PAGE_CONTENTS_PAGE_ID;
		}

		if ($this->aSfPageContentsPage !== null && $this->aSfPageContentsPage->getId() !== $v) {
			$this->aSfPageContentsPage = null;
		}

	} 
	
	public function setSfPageContentsContentId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->sf_page_contents_content_id !== $v) {
			$this->sf_page_contents_content_id = $v;
			$this->modifiedColumns[] = SfPageContentsPageContentPeer::SF_PAGE_CONTENTS_CONTENT_ID;
		}

		if ($this->aSfPageContentsContent !== null && $this->aSfPageContentsContent->getId() !== $v) {
			$this->aSfPageContentsContent = null;
		}

	} 
	
	public function setShowOrder($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->show_order !== $v || $v === 1) {
			$this->show_order = $v;
			$this->modifiedColumns[] = SfPageContentsPageContentPeer::SHOW_ORDER;
		}

	} 
	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = SfPageContentsPageContentPeer::ID;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->sf_page_contents_page_id = $rs->getInt($startcol + 0);

			$this->sf_page_contents_content_id = $rs->getInt($startcol + 1);

			$this->show_order = $rs->getInt($startcol + 2);

			$this->id = $rs->getInt($startcol + 3);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 4; 
		} catch (Exception $e) {
			throw new PropelException("Error populating SfPageContentsPageContent object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(SfPageContentsPageContentPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			SfPageContentsPageContentPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(SfPageContentsPageContentPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	protected function doSave($con)
	{
		$affectedRows = 0; 		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;


												
			if ($this->aSfPageContentsPage !== null) {
				if ($this->aSfPageContentsPage->isModified()) {
					$affectedRows += $this->aSfPageContentsPage->save($con);
				}
				$this->setSfPageContentsPage($this->aSfPageContentsPage);
			}

			if ($this->aSfPageContentsContent !== null) {
				if ($this->aSfPageContentsContent->isModified()) {
					$affectedRows += $this->aSfPageContentsContent->save($con);
				}
				$this->setSfPageContentsContent($this->aSfPageContentsContent);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = SfPageContentsPageContentPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += SfPageContentsPageContentPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			$this->alreadyInSave = false;
		}
		return $affectedRows;
	} 
	
	protected $validationFailures = array();

	
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


												
			if ($this->aSfPageContentsPage !== null) {
				if (!$this->aSfPageContentsPage->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aSfPageContentsPage->getValidationFailures());
				}
			}

			if ($this->aSfPageContentsContent !== null) {
				if (!$this->aSfPageContentsContent->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aSfPageContentsContent->getValidationFailures());
				}
			}


			if (($retval = SfPageContentsPageContentPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SfPageContentsPageContentPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getSfPageContentsPageId();
				break;
			case 1:
				return $this->getSfPageContentsContentId();
				break;
			case 2:
				return $this->getShowOrder();
				break;
			case 3:
				return $this->getId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SfPageContentsPageContentPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getSfPageContentsPageId(),
			$keys[1] => $this->getSfPageContentsContentId(),
			$keys[2] => $this->getShowOrder(),
			$keys[3] => $this->getId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SfPageContentsPageContentPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setSfPageContentsPageId($value);
				break;
			case 1:
				$this->setSfPageContentsContentId($value);
				break;
			case 2:
				$this->setShowOrder($value);
				break;
			case 3:
				$this->setId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SfPageContentsPageContentPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setSfPageContentsPageId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setSfPageContentsContentId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setShowOrder($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setId($arr[$keys[3]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(SfPageContentsPageContentPeer::DATABASE_NAME);

		if ($this->isColumnModified(SfPageContentsPageContentPeer::SF_PAGE_CONTENTS_PAGE_ID)) $criteria->add(SfPageContentsPageContentPeer::SF_PAGE_CONTENTS_PAGE_ID, $this->sf_page_contents_page_id);
		if ($this->isColumnModified(SfPageContentsPageContentPeer::SF_PAGE_CONTENTS_CONTENT_ID)) $criteria->add(SfPageContentsPageContentPeer::SF_PAGE_CONTENTS_CONTENT_ID, $this->sf_page_contents_content_id);
		if ($this->isColumnModified(SfPageContentsPageContentPeer::SHOW_ORDER)) $criteria->add(SfPageContentsPageContentPeer::SHOW_ORDER, $this->show_order);
		if ($this->isColumnModified(SfPageContentsPageContentPeer::ID)) $criteria->add(SfPageContentsPageContentPeer::ID, $this->id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(SfPageContentsPageContentPeer::DATABASE_NAME);

		$criteria->add(SfPageContentsPageContentPeer::ID, $this->id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setSfPageContentsPageId($this->sf_page_contents_page_id);

		$copyObj->setSfPageContentsContentId($this->sf_page_contents_content_id);

		$copyObj->setShowOrder($this->show_order);


		$copyObj->setNew(true);

		$copyObj->setId(NULL); 
	}

	
	public function copy($deepCopy = false)
	{
				$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new SfPageContentsPageContentPeer();
		}
		return self::$peer;
	}

	
	public function setSfPageContentsPage($v)
	{


		if ($v === null) {
			$this->setSfPageContentsPageId(NULL);
		} else {
			$this->setSfPageContentsPageId($v->getId());
		}


		$this->aSfPageContentsPage = $v;
	}


	
	public function getSfPageContentsPage($con = null)
	{
		if ($this->aSfPageContentsPage === null && ($this->sf_page_contents_page_id !== null)) {
						include_once 'plugins/sfPageContentsPlugin/lib/model/om/BaseSfPageContentsPagePeer.php';

			$this->aSfPageContentsPage = SfPageContentsPagePeer::retrieveByPK($this->sf_page_contents_page_id, $con);

			
		}
		return $this->aSfPageContentsPage;
	}

	
	public function setSfPageContentsContent($v)
	{


		if ($v === null) {
			$this->setSfPageContentsContentId(NULL);
		} else {
			$this->setSfPageContentsContentId($v->getId());
		}


		$this->aSfPageContentsContent = $v;
	}


	
	public function getSfPageContentsContent($con = null)
	{
		if ($this->aSfPageContentsContent === null && ($this->sf_page_contents_content_id !== null)) {
						include_once 'plugins/sfPageContentsPlugin/lib/model/om/BaseSfPageContentsContentPeer.php';

			$this->aSfPageContentsContent = SfPageContentsContentPeer::retrieveByPK($this->sf_page_contents_content_id, $con);

			
		}
		return $this->aSfPageContentsContent;
	}

} 