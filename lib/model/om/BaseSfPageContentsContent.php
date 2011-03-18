<?php


abstract class BaseSfPageContentsContent extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $name;


	
	protected $body;


	
	protected $modul = 'content';


	
	protected $action = 'show';


	
	protected $created_at;


	
	protected $updated_at;


	
	protected $id;

	
	protected $collSfPageContentsPageContents;

	
	protected $lastSfPageContentsPageContentCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getName()
	{

		return $this->name;
	}

	
	public function getBody()
	{

		return $this->body;
	}

	
	public function getModul()
	{

		return $this->modul;
	}

	
	public function getAction()
	{

		return $this->action;
	}

	
	public function getCreatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->created_at === null || $this->created_at === '') {
			return null;
		} elseif (!is_int($this->created_at)) {
						$ts = strtotime($this->created_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [created_at] as date/time value: " . var_export($this->created_at, true));
			}
		} else {
			$ts = $this->created_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getUpdatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->updated_at === null || $this->updated_at === '') {
			return null;
		} elseif (!is_int($this->updated_at)) {
						$ts = strtotime($this->updated_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [updated_at] as date/time value: " . var_export($this->updated_at, true));
			}
		} else {
			$ts = $this->updated_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getId()
	{

		return $this->id;
	}

	
	public function setName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = SfPageContentsContentPeer::NAME;
		}

	} 
	
	public function setBody($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->body !== $v) {
			$this->body = $v;
			$this->modifiedColumns[] = SfPageContentsContentPeer::BODY;
		}

	} 
	
	public function setModul($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->modul !== $v || $v === 'content') {
			$this->modul = $v;
			$this->modifiedColumns[] = SfPageContentsContentPeer::MODUL;
		}

	} 
	
	public function setAction($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->action !== $v || $v === 'show') {
			$this->action = $v;
			$this->modifiedColumns[] = SfPageContentsContentPeer::ACTION;
		}

	} 
	
	public function setCreatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [created_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->created_at !== $ts) {
			$this->created_at = $ts;
			$this->modifiedColumns[] = SfPageContentsContentPeer::CREATED_AT;
		}

	} 
	
	public function setUpdatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [updated_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->updated_at !== $ts) {
			$this->updated_at = $ts;
			$this->modifiedColumns[] = SfPageContentsContentPeer::UPDATED_AT;
		}

	} 
	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = SfPageContentsContentPeer::ID;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->name = $rs->getString($startcol + 0);

			$this->body = $rs->getString($startcol + 1);

			$this->modul = $rs->getString($startcol + 2);

			$this->action = $rs->getString($startcol + 3);

			$this->created_at = $rs->getTimestamp($startcol + 4, null);

			$this->updated_at = $rs->getTimestamp($startcol + 5, null);

			$this->id = $rs->getInt($startcol + 6);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 7; 
		} catch (Exception $e) {
			throw new PropelException("Error populating SfPageContentsContent object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(SfPageContentsContentPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			SfPageContentsContentPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(SfPageContentsContentPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(SfPageContentsContentPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(SfPageContentsContentPeer::DATABASE_NAME);
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


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = SfPageContentsContentPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += SfPageContentsContentPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collSfPageContentsPageContents !== null) {
				foreach($this->collSfPageContentsPageContents as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

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


			if (($retval = SfPageContentsContentPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collSfPageContentsPageContents !== null) {
					foreach($this->collSfPageContentsPageContents as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SfPageContentsContentPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getName();
				break;
			case 1:
				return $this->getBody();
				break;
			case 2:
				return $this->getModul();
				break;
			case 3:
				return $this->getAction();
				break;
			case 4:
				return $this->getCreatedAt();
				break;
			case 5:
				return $this->getUpdatedAt();
				break;
			case 6:
				return $this->getId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SfPageContentsContentPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getName(),
			$keys[1] => $this->getBody(),
			$keys[2] => $this->getModul(),
			$keys[3] => $this->getAction(),
			$keys[4] => $this->getCreatedAt(),
			$keys[5] => $this->getUpdatedAt(),
			$keys[6] => $this->getId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SfPageContentsContentPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setName($value);
				break;
			case 1:
				$this->setBody($value);
				break;
			case 2:
				$this->setModul($value);
				break;
			case 3:
				$this->setAction($value);
				break;
			case 4:
				$this->setCreatedAt($value);
				break;
			case 5:
				$this->setUpdatedAt($value);
				break;
			case 6:
				$this->setId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SfPageContentsContentPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setName($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setBody($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setModul($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setAction($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCreatedAt($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setUpdatedAt($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setId($arr[$keys[6]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(SfPageContentsContentPeer::DATABASE_NAME);

		if ($this->isColumnModified(SfPageContentsContentPeer::NAME)) $criteria->add(SfPageContentsContentPeer::NAME, $this->name);
		if ($this->isColumnModified(SfPageContentsContentPeer::BODY)) $criteria->add(SfPageContentsContentPeer::BODY, $this->body);
		if ($this->isColumnModified(SfPageContentsContentPeer::MODUL)) $criteria->add(SfPageContentsContentPeer::MODUL, $this->modul);
		if ($this->isColumnModified(SfPageContentsContentPeer::ACTION)) $criteria->add(SfPageContentsContentPeer::ACTION, $this->action);
		if ($this->isColumnModified(SfPageContentsContentPeer::CREATED_AT)) $criteria->add(SfPageContentsContentPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(SfPageContentsContentPeer::UPDATED_AT)) $criteria->add(SfPageContentsContentPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(SfPageContentsContentPeer::ID)) $criteria->add(SfPageContentsContentPeer::ID, $this->id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(SfPageContentsContentPeer::DATABASE_NAME);

		$criteria->add(SfPageContentsContentPeer::ID, $this->id);

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

		$copyObj->setName($this->name);

		$copyObj->setBody($this->body);

		$copyObj->setModul($this->modul);

		$copyObj->setAction($this->action);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getSfPageContentsPageContents() as $relObj) {
				$copyObj->addSfPageContentsPageContent($relObj->copy($deepCopy));
			}

		} 

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
			self::$peer = new SfPageContentsContentPeer();
		}
		return self::$peer;
	}

	
	public function initSfPageContentsPageContents()
	{
		if ($this->collSfPageContentsPageContents === null) {
			$this->collSfPageContentsPageContents = array();
		}
	}

	
	public function getSfPageContentsPageContents($criteria = null, $con = null)
	{
				include_once 'plugins/sfPageContentsPlugin/lib/model/om/BaseSfPageContentsPageContentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSfPageContentsPageContents === null) {
			if ($this->isNew()) {
			   $this->collSfPageContentsPageContents = array();
			} else {

				$criteria->add(SfPageContentsPageContentPeer::SF_PAGE_CONTENTS_CONTENT_ID, $this->getId());

				SfPageContentsPageContentPeer::addSelectColumns($criteria);
				$this->collSfPageContentsPageContents = SfPageContentsPageContentPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(SfPageContentsPageContentPeer::SF_PAGE_CONTENTS_CONTENT_ID, $this->getId());

				SfPageContentsPageContentPeer::addSelectColumns($criteria);
				if (!isset($this->lastSfPageContentsPageContentCriteria) || !$this->lastSfPageContentsPageContentCriteria->equals($criteria)) {
					$this->collSfPageContentsPageContents = SfPageContentsPageContentPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSfPageContentsPageContentCriteria = $criteria;
		return $this->collSfPageContentsPageContents;
	}

	
	public function countSfPageContentsPageContents($criteria = null, $distinct = false, $con = null)
	{
				include_once 'plugins/sfPageContentsPlugin/lib/model/om/BaseSfPageContentsPageContentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(SfPageContentsPageContentPeer::SF_PAGE_CONTENTS_CONTENT_ID, $this->getId());

		return SfPageContentsPageContentPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addSfPageContentsPageContent(SfPageContentsPageContent $l)
	{
		$this->collSfPageContentsPageContents[] = $l;
		$l->setSfPageContentsContent($this);
	}


	
	public function getSfPageContentsPageContentsJoinSfPageContentsPage($criteria = null, $con = null)
	{
				include_once 'plugins/sfPageContentsPlugin/lib/model/om/BaseSfPageContentsPageContentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSfPageContentsPageContents === null) {
			if ($this->isNew()) {
				$this->collSfPageContentsPageContents = array();
			} else {

				$criteria->add(SfPageContentsPageContentPeer::SF_PAGE_CONTENTS_CONTENT_ID, $this->getId());

				$this->collSfPageContentsPageContents = SfPageContentsPageContentPeer::doSelectJoinSfPageContentsPage($criteria, $con);
			}
		} else {
									
			$criteria->add(SfPageContentsPageContentPeer::SF_PAGE_CONTENTS_CONTENT_ID, $this->getId());

			if (!isset($this->lastSfPageContentsPageContentCriteria) || !$this->lastSfPageContentsPageContentCriteria->equals($criteria)) {
				$this->collSfPageContentsPageContents = SfPageContentsPageContentPeer::doSelectJoinSfPageContentsPage($criteria, $con);
			}
		}
		$this->lastSfPageContentsPageContentCriteria = $criteria;

		return $this->collSfPageContentsPageContents;
	}

} 