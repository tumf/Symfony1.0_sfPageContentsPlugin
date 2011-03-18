<?php


abstract class BaseSfPageContentsPage extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $name;


	
	protected $title = '';


	
	protected $keywords = '';


	
	protected $description = '';


	
	protected $url;


	
	protected $layout = 'layout';


	
	protected $is_public = false;


	
	protected $body;


	
	protected $modul = 'page';


	
	protected $action = 'show';


	
	protected $release_begin;


	
	protected $release_end;


	
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

	
	public function getTitle()
	{

		return $this->title;
	}

	
	public function getKeywords()
	{

		return $this->keywords;
	}

	
	public function getDescription()
	{

		return $this->description;
	}

	
	public function getUrl()
	{

		return $this->url;
	}

	
	public function getLayout()
	{

		return $this->layout;
	}

	
	public function getIsPublic()
	{

		return $this->is_public;
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

	
	public function getReleaseBegin($format = 'Y-m-d H:i:s')
	{

		if ($this->release_begin === null || $this->release_begin === '') {
			return null;
		} elseif (!is_int($this->release_begin)) {
						$ts = strtotime($this->release_begin);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [release_begin] as date/time value: " . var_export($this->release_begin, true));
			}
		} else {
			$ts = $this->release_begin;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getReleaseEnd($format = 'Y-m-d H:i:s')
	{

		if ($this->release_end === null || $this->release_end === '') {
			return null;
		} elseif (!is_int($this->release_end)) {
						$ts = strtotime($this->release_end);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [release_end] as date/time value: " . var_export($this->release_end, true));
			}
		} else {
			$ts = $this->release_end;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
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
			$this->modifiedColumns[] = SfPageContentsPagePeer::NAME;
		}

	} 
	
	public function setTitle($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->title !== $v || $v === '') {
			$this->title = $v;
			$this->modifiedColumns[] = SfPageContentsPagePeer::TITLE;
		}

	} 
	
	public function setKeywords($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->keywords !== $v || $v === '') {
			$this->keywords = $v;
			$this->modifiedColumns[] = SfPageContentsPagePeer::KEYWORDS;
		}

	} 
	
	public function setDescription($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description !== $v || $v === '') {
			$this->description = $v;
			$this->modifiedColumns[] = SfPageContentsPagePeer::DESCRIPTION;
		}

	} 
	
	public function setUrl($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->url !== $v) {
			$this->url = $v;
			$this->modifiedColumns[] = SfPageContentsPagePeer::URL;
		}

	} 
	
	public function setLayout($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->layout !== $v || $v === 'layout') {
			$this->layout = $v;
			$this->modifiedColumns[] = SfPageContentsPagePeer::LAYOUT;
		}

	} 
	
	public function setIsPublic($v)
	{

		if ($this->is_public !== $v || $v === false) {
			$this->is_public = $v;
			$this->modifiedColumns[] = SfPageContentsPagePeer::IS_PUBLIC;
		}

	} 
	
	public function setBody($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->body !== $v) {
			$this->body = $v;
			$this->modifiedColumns[] = SfPageContentsPagePeer::BODY;
		}

	} 
	
	public function setModul($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->modul !== $v || $v === 'page') {
			$this->modul = $v;
			$this->modifiedColumns[] = SfPageContentsPagePeer::MODUL;
		}

	} 
	
	public function setAction($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->action !== $v || $v === 'show') {
			$this->action = $v;
			$this->modifiedColumns[] = SfPageContentsPagePeer::ACTION;
		}

	} 
	
	public function setReleaseBegin($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [release_begin] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->release_begin !== $ts) {
			$this->release_begin = $ts;
			$this->modifiedColumns[] = SfPageContentsPagePeer::RELEASE_BEGIN;
		}

	} 
	
	public function setReleaseEnd($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [release_end] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->release_end !== $ts) {
			$this->release_end = $ts;
			$this->modifiedColumns[] = SfPageContentsPagePeer::RELEASE_END;
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
			$this->modifiedColumns[] = SfPageContentsPagePeer::CREATED_AT;
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
			$this->modifiedColumns[] = SfPageContentsPagePeer::UPDATED_AT;
		}

	} 
	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = SfPageContentsPagePeer::ID;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->name = $rs->getString($startcol + 0);

			$this->title = $rs->getString($startcol + 1);

			$this->keywords = $rs->getString($startcol + 2);

			$this->description = $rs->getString($startcol + 3);

			$this->url = $rs->getString($startcol + 4);

			$this->layout = $rs->getString($startcol + 5);

			$this->is_public = $rs->getBoolean($startcol + 6);

			$this->body = $rs->getString($startcol + 7);

			$this->modul = $rs->getString($startcol + 8);

			$this->action = $rs->getString($startcol + 9);

			$this->release_begin = $rs->getTimestamp($startcol + 10, null);

			$this->release_end = $rs->getTimestamp($startcol + 11, null);

			$this->created_at = $rs->getTimestamp($startcol + 12, null);

			$this->updated_at = $rs->getTimestamp($startcol + 13, null);

			$this->id = $rs->getInt($startcol + 14);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 15; 
		} catch (Exception $e) {
			throw new PropelException("Error populating SfPageContentsPage object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(SfPageContentsPagePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			SfPageContentsPagePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(SfPageContentsPagePeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(SfPageContentsPagePeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(SfPageContentsPagePeer::DATABASE_NAME);
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
					$pk = SfPageContentsPagePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += SfPageContentsPagePeer::doUpdate($this, $con);
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


			if (($retval = SfPageContentsPagePeer::doValidate($this, $columns)) !== true) {
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
		$pos = SfPageContentsPagePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getName();
				break;
			case 1:
				return $this->getTitle();
				break;
			case 2:
				return $this->getKeywords();
				break;
			case 3:
				return $this->getDescription();
				break;
			case 4:
				return $this->getUrl();
				break;
			case 5:
				return $this->getLayout();
				break;
			case 6:
				return $this->getIsPublic();
				break;
			case 7:
				return $this->getBody();
				break;
			case 8:
				return $this->getModul();
				break;
			case 9:
				return $this->getAction();
				break;
			case 10:
				return $this->getReleaseBegin();
				break;
			case 11:
				return $this->getReleaseEnd();
				break;
			case 12:
				return $this->getCreatedAt();
				break;
			case 13:
				return $this->getUpdatedAt();
				break;
			case 14:
				return $this->getId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SfPageContentsPagePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getName(),
			$keys[1] => $this->getTitle(),
			$keys[2] => $this->getKeywords(),
			$keys[3] => $this->getDescription(),
			$keys[4] => $this->getUrl(),
			$keys[5] => $this->getLayout(),
			$keys[6] => $this->getIsPublic(),
			$keys[7] => $this->getBody(),
			$keys[8] => $this->getModul(),
			$keys[9] => $this->getAction(),
			$keys[10] => $this->getReleaseBegin(),
			$keys[11] => $this->getReleaseEnd(),
			$keys[12] => $this->getCreatedAt(),
			$keys[13] => $this->getUpdatedAt(),
			$keys[14] => $this->getId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SfPageContentsPagePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setName($value);
				break;
			case 1:
				$this->setTitle($value);
				break;
			case 2:
				$this->setKeywords($value);
				break;
			case 3:
				$this->setDescription($value);
				break;
			case 4:
				$this->setUrl($value);
				break;
			case 5:
				$this->setLayout($value);
				break;
			case 6:
				$this->setIsPublic($value);
				break;
			case 7:
				$this->setBody($value);
				break;
			case 8:
				$this->setModul($value);
				break;
			case 9:
				$this->setAction($value);
				break;
			case 10:
				$this->setReleaseBegin($value);
				break;
			case 11:
				$this->setReleaseEnd($value);
				break;
			case 12:
				$this->setCreatedAt($value);
				break;
			case 13:
				$this->setUpdatedAt($value);
				break;
			case 14:
				$this->setId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SfPageContentsPagePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setName($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setTitle($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setKeywords($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setDescription($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setUrl($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setLayout($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setIsPublic($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setBody($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setModul($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setAction($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setReleaseBegin($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setReleaseEnd($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCreatedAt($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setUpdatedAt($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setId($arr[$keys[14]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(SfPageContentsPagePeer::DATABASE_NAME);

		if ($this->isColumnModified(SfPageContentsPagePeer::NAME)) $criteria->add(SfPageContentsPagePeer::NAME, $this->name);
		if ($this->isColumnModified(SfPageContentsPagePeer::TITLE)) $criteria->add(SfPageContentsPagePeer::TITLE, $this->title);
		if ($this->isColumnModified(SfPageContentsPagePeer::KEYWORDS)) $criteria->add(SfPageContentsPagePeer::KEYWORDS, $this->keywords);
		if ($this->isColumnModified(SfPageContentsPagePeer::DESCRIPTION)) $criteria->add(SfPageContentsPagePeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(SfPageContentsPagePeer::URL)) $criteria->add(SfPageContentsPagePeer::URL, $this->url);
		if ($this->isColumnModified(SfPageContentsPagePeer::LAYOUT)) $criteria->add(SfPageContentsPagePeer::LAYOUT, $this->layout);
		if ($this->isColumnModified(SfPageContentsPagePeer::IS_PUBLIC)) $criteria->add(SfPageContentsPagePeer::IS_PUBLIC, $this->is_public);
		if ($this->isColumnModified(SfPageContentsPagePeer::BODY)) $criteria->add(SfPageContentsPagePeer::BODY, $this->body);
		if ($this->isColumnModified(SfPageContentsPagePeer::MODUL)) $criteria->add(SfPageContentsPagePeer::MODUL, $this->modul);
		if ($this->isColumnModified(SfPageContentsPagePeer::ACTION)) $criteria->add(SfPageContentsPagePeer::ACTION, $this->action);
		if ($this->isColumnModified(SfPageContentsPagePeer::RELEASE_BEGIN)) $criteria->add(SfPageContentsPagePeer::RELEASE_BEGIN, $this->release_begin);
		if ($this->isColumnModified(SfPageContentsPagePeer::RELEASE_END)) $criteria->add(SfPageContentsPagePeer::RELEASE_END, $this->release_end);
		if ($this->isColumnModified(SfPageContentsPagePeer::CREATED_AT)) $criteria->add(SfPageContentsPagePeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(SfPageContentsPagePeer::UPDATED_AT)) $criteria->add(SfPageContentsPagePeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(SfPageContentsPagePeer::ID)) $criteria->add(SfPageContentsPagePeer::ID, $this->id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(SfPageContentsPagePeer::DATABASE_NAME);

		$criteria->add(SfPageContentsPagePeer::ID, $this->id);

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

		$copyObj->setTitle($this->title);

		$copyObj->setKeywords($this->keywords);

		$copyObj->setDescription($this->description);

		$copyObj->setUrl($this->url);

		$copyObj->setLayout($this->layout);

		$copyObj->setIsPublic($this->is_public);

		$copyObj->setBody($this->body);

		$copyObj->setModul($this->modul);

		$copyObj->setAction($this->action);

		$copyObj->setReleaseBegin($this->release_begin);

		$copyObj->setReleaseEnd($this->release_end);

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
			self::$peer = new SfPageContentsPagePeer();
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

				$criteria->add(SfPageContentsPageContentPeer::SF_PAGE_CONTENTS_PAGE_ID, $this->getId());

				SfPageContentsPageContentPeer::addSelectColumns($criteria);
				$this->collSfPageContentsPageContents = SfPageContentsPageContentPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(SfPageContentsPageContentPeer::SF_PAGE_CONTENTS_PAGE_ID, $this->getId());

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

		$criteria->add(SfPageContentsPageContentPeer::SF_PAGE_CONTENTS_PAGE_ID, $this->getId());

		return SfPageContentsPageContentPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addSfPageContentsPageContent(SfPageContentsPageContent $l)
	{
		$this->collSfPageContentsPageContents[] = $l;
		$l->setSfPageContentsPage($this);
	}


	
	public function getSfPageContentsPageContentsJoinSfPageContentsContent($criteria = null, $con = null)
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

				$criteria->add(SfPageContentsPageContentPeer::SF_PAGE_CONTENTS_PAGE_ID, $this->getId());

				$this->collSfPageContentsPageContents = SfPageContentsPageContentPeer::doSelectJoinSfPageContentsContent($criteria, $con);
			}
		} else {
									
			$criteria->add(SfPageContentsPageContentPeer::SF_PAGE_CONTENTS_PAGE_ID, $this->getId());

			if (!isset($this->lastSfPageContentsPageContentCriteria) || !$this->lastSfPageContentsPageContentCriteria->equals($criteria)) {
				$this->collSfPageContentsPageContents = SfPageContentsPageContentPeer::doSelectJoinSfPageContentsContent($criteria, $con);
			}
		}
		$this->lastSfPageContentsPageContentCriteria = $criteria;

		return $this->collSfPageContentsPageContents;
	}

} 