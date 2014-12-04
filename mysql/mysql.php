<?php
header ( 'Content-Type: text/html; charset=utf-8' );
class Mysql {
	private $host;
	private $user;
	private $pwd;
	private $dbName;
	private $charset;
	private $conn;
	
	public function __construct() {
		
		//		$this->host = 'localhost';
		//		$this->user = 'root';
		//		$this->pwd = '123456';
		$this->host = '115.28.133.116';
		$this->user = 'root';
		$this->pwd = 'b4d61fb89d';
		$this->dbName = 'shop';
		$this->charset = 'UTF8';
		$this->conn = $this->connect ( $this->host, $this->user, $this->pwd );
		$this->switchDb ( $this->dbName );
		$this->setChart ( $this->charset );
	}
	
	private function connect($h, $u, $p) {
		return mysql_connect ( $h, $u, $p );
	}
	
	public function switchDb($dbName) {
		$this->query ( 'use ' . $dbName );
	}
	
	public function setChart($char) {
		$sql = 'set names ' . $char;
		$this->query ( $sql );
	
	}
	
	public function query($sql) {
		return mysql_query ( $sql, $this->conn );
	}
	public function returnQuery($sql) {
		return mysql_query ( $sql, $this->conn );
	}
	public function getAll($sql) {
		$list = array ();
		$rs = $this->returnQuery ( $sql );
		if (! $rs) {
			return false;
		}
		while ( $row = mysql_fetch_assoc ( $rs ) ) {
			$list [] = $row;
		}
		return $list;
	
	}
	public function getRow($sql) {
		$rs = $this->query ( $sql );
		if (! $rs) {
			return false;
		
		}
		return mysql_fetch_assoc ( $rs );
	}
	public function getOne($sql) {
		$rs = $this->query ( $sql );
		if (! $rs) {
			return false;
		}
		$row = mysql_fetch_row ( $rs );
		return $row [0];
	
	}
	public function updateID($id) {
		$uid;
		if (strlen ( $id ) == 1) {
			$uid = "000" . $id;
		} elseif (strlen ( $id ) == 2) {
			$uid = "00" . $id;
		} elseif (strlen ( $id ) == 3) {
			$uid = "0" . $id;
		} else {
			$uid = $id;
		}
		return $uid;
	}
	public function getNum($sql) {
		$result = mysql_query ( $sql );
		$_num = mysql_num_rows ( $result );
		return $_num;
	}
}

class user extends Mysql {
	public function change($which,$uid){
		$sql="select * from user where UID='{$uid}'";
		$row=$this->getRow($sql);
		if($row['UINTEGRAL']>50){
			$sql="update user set UINTEGRAL=UINTEGRAL-50,$which=$which+1 where UID='{$uid}'";
			$this->query($sql);
			return true;
		}
		return false;
		
		
	}
	
	public function insert($uname, $usex, $utel, $uemail, $uaddress, $laccount, $lpassword,$kind=0) {
		date_default_timezone_set ( 'PRC' );
		$ucreateDate = date ( 'Y-m-d H:i:s' );
		$sql = "INSERT INTO user(
	UNAME,
	USEX,
	UTEL,
	UEMAIL,
	UADDRESS,
	UCREATEDATE,
	UKIND
	) VALUES(
	'{$uname}',
	'{$usex}',
	'{$utel}',
	'{$uemail}',
	'{$uaddress}',
	'{$ucreateDate}',
	$kind
	)";
		$this->query ( $sql );
		//更新uid
		$id = mysql_insert_id ();
		$Uid = $this->updateID ( $id );
		$sql = "update user set UID = '{$Uid}' where ID= '{$id}'";
		$this->query ( $sql );
		$sql = "insert into userlogin (
		UID,
		LACCOUNT,
		LPASSWORD
		) values(
		'{$Uid}',
		'{$laccount}',
		'{$lpassword}'
		)";
		$this->query ( $sql );
		return true;
	
	}
	public function ifHasAccount($laccount) {
		$sql = "SELECT * FROM userlogin WHERE LACCOUNT='{$laccount}'";
		$_num = $this->getNum ( $sql );
		if ($_num == 0) {
			return false;
		}
		return true;
	
	}
	public function fetchLogin($laccoutn, $lpassword) {
		$sql = "select * from userlogin where LACCOUNT='{$laccoutn}' and LPASSWORD='{$lpassword}'";
		$result = $this->returnQuery ( $sql );
		if (! mysql_fetch_assoc ( $result )) {
			return false;
		}
		return true;
	
	}
	public function getAllInfo($kind) {
		$sql = "select * from user where UKIND=$kind and UISDELETED=0";
		return $this->getAll ( $sql );
	}
	public function getAllInfoNot2() {
		$sql = "select * from user where UKIND!=2 and UISDELETED=0";
		return $this->getAll ( $sql );
	}
	
	public function updateInfo($uid, $uname, $usex, $utel, $uemail, $uaddress) {
		$sql = "update user set UNAME='{$uname}',USEX='{$usex}',UTEL='{$utel}',UEMAIL='{$uemail}',UADDRESS='{$uaddress}' where UID ='{$uid}'";
		if ($this->returnQuery ( $sql )) {
			return true;
		}
		return false;
	}
	public function updateInfoDiscount($uid, $uintegral, $umeasurementtime, $ucorrectiontime, $umaintenancetimel, $uexdisign) {
		$sql = "update user set UINTEGRAL='{$uintegral}',UMEASUREMENTTIME='{$umeasurementtime}',UCORRECTIONTIME='{$ucorrectiontime}',UMAINTENANCETIME='{$umaintenancetimel}',UEXDISIGN='{$uexdisign}' where UID ='{$uid}'";
		if ($this->returnQuery ( $sql )) {
			return true;
		}
		return false;
	}
	
	public function deleteOne($uid) {
		$sql = "update user set UISDELETED = 1 where UID = '{$uid}'";
		if ($this->returnQuery ( $sql )) {
			return true;
		}
		return false;
	}
	public function updateOne($uid) {
		$sql = "update user set UKIND = 1 ,UMEASUREMENTTIME=UMEASUREMENTTIME+1, UCORRECTIONTIME=UCORRECTIONTIME+1,UMAINTENANCETIME=UMAINTENANCETIME+1  where UID = '{$uid}'";
		if ($this->returnQuery ( $sql )) {
			return true;
		}
		return false;
	}
	public function updateZero($uid) {
		$sql = "update user set UKIND = 0 where UID = '{$uid}'";
		if ($this->returnQuery ( $sql )) {
			return true;
		}
		return false;
	}
	public function getUOne($uid) {
		$sql = "select * from user where UID = '{$uid}'";
		$rs = $this->returnQuery ( $sql );
		if (! $rs) {
			return false;
		}
		$row = mysql_fetch_array ( $rs );
		return $row;
	}

}

class manager extends Mysql {
	public function fetchLogin($root, $password) {
		$sql = "select * from manager where ROOT='{$root}' and PASSWORD='{$password}'";
		$result = $this->returnQuery ( $sql );
		if (! mysql_fetch_assoc ( $result )) {
			return false;
		}
		return true;
	
	}

}
class good extends Mysql {
	public function insert($gname, $gprice, $gnum, $gstyle, $gpic0, $gpic1, $gpic2, $gpic3, $gpic4, $gpic5, $gpic6) {
		date_default_timezone_set ( 'PRC' );
		$gUpDate = date ( 'Y-m-d H:i:s' );
		$sql = "INSERT INTO good(
	GNAME,
	GPRICE,
	GNUM,
	GSTYLE,
	GPIC0,
	GPIC1,
	GPIC2,
	GPIC3,
	GPIC4,
	GPIC5,
	GPIC6,
	GUPDATE
	) VALUES(
	'{$gname}',
	{$gprice},
	{$gnum},
	'{$gstyle}',
	'{$gpic0}',
	'{$gpic1}',
	'{$gpic2}',
	'{$gpic3}',
	'{$gpic4}',
	'{$gpic5}',
	'{$gpic6}',
	'{$gUpDate}'
	)";
		$this->query ( $sql );
		//更新uid
		$id = mysql_insert_id ();
		$gid = $this->updateID ( $id );
		$sql = "update good set GID = '{$gid}' where ID= '{$id}'";
		$this->query ( $sql );
	}
	public function getAllInfo() {
		$sql = "select * from good where  GISDELETED=0 order by GUPDATE desc";
		return $this->getAll ( $sql );
	}
	public function updateInfo($gid, $gname, $gprice, $gnum, $gstyle) {
		$sql = "update good set GNAME='{$gname}',GPRICE='{$gprice}',GNUM='{$gnum}',GSTYLE='{$gstyle}' where GID ='{$gid}'";
		if ($this->returnQuery ( $sql )) {
			return true;
		}
		return false;
	}
	public function deleteOne($gid) {
		$sql = "update good set GISDELETED = 1 where GID = '{$gid}'";
		if ($this->returnQuery ( $sql )) {
			return true;
		}
		return false;
	}
	public function getGOne($gid) {
		$sql = "select * from good where GID = '{$gid}'";
		$rs = $this->returnQuery ( $sql );
		if (! $rs) {
			return false;
		}
		$row = mysql_fetch_array ( $rs );
		return $row;
	}
}
class shopOrder extends Mysql {
	public function deleteOne($oid) {
		$sql = "update shoporder set OISDELETED=1 where OID = '{$oid}'";
		if ($this->returnQuery ( $sql )) {
			return true;
		}
		return false;
	}
	public function getAllInfo() {
		$sql = "select * from shoporder where  OISDELETED=0 order by OCREATEDATE desc";
		return $this->getAll ( $sql );
	}
	public function getSomeOrder($uid) {
		$sql = "select * from shoporder where OUID = '{$uid}'";
		return $this->getAll ( $sql );
	}
	public function updateOkind($oid) {
		$sql = "update shoporder set OKIND = 1  where OID = '{$oid}'";
		if ($this->returnQuery ( $sql )) {
			return true;
		}
		return false;
	}
	
	public function updateOState($oid) {
		$sql = "update shoporder set OSTATE = 1  where OID = '{$oid}'";
		if ($this->returnQuery ( $sql )) {
			//up次数
			$sql = "select * from shoporder where OID='{$oid}'";
			$row = $this->getRow ( $sql );
			if ($row['OGIFT'] == "无偿体型测量机会") {
				$sql = "update user set UMEASUREMENTTIME=UMEASUREMENTTIME-1 where UID='{$row['OUID']}'";
				$this->query ( $sql );
			
			}
			if ($row['OGIFT'] == "额外设计服务机会") {
				$sql = "update user set UEXDISIGN=UEXDISIGN-1 where UID='{$row['OUID']}'";
				$this->query ( $sql );
			}
			//UP money
			$sql= "update user set UBUYCOUNT=UBUYCOUNT+'{$row['OGPRICEPRE']}' where UID='{$row['OUID']}'";
			$this->query ( $sql );
			//up if moneyall>2 找到该用户，如果是普通用户 若金额超过2000则 升级 并且赠送
			$sql ="select * from user where UID='{$row['OUID']}'";
			$userRow=$this->getRow($sql);
			if($userRow['UKIND']==0&&$userRow['UBUYCOUNT']>20000){
				$sql = "update user set UKIND=1,UMEASUREMENTTIME=UMEASUREMENTTIME+1,UEXDISIGN=UEXDISIGN+1 where UID='{$row['OUID']}'";
				$this->query ( $sql );
			}
			//up 积分
			$thisMoney=$row['OGPRICEPRE'];
			$thisInt=(int)($thisMoney/100);
			$sql = "update user set UINTEGRAL=UINTEGRAL+$thisInt where UID='{$row['OUID']}'";
			$this->query ( $sql );
			
			return true;
		}
		return false;
	}
	public function insert(stdClass $data) {
		$sql = "INSERT INTO  shoporder (
		OUNAME,
		OGID,
		OADDRESS,
		OBOOKDATE,
		OBOOKSERVICE,
		OPOSTSELECT,
		OGIFT,
		OGPRICE,
		OGPRICEPRE,
		OCREATEDATE,
		OUID,
		OPROVINCE,
		OCITY,
		OAREA
		) VALUES(
		'{$data->ouname}',
		'{$data->ogid}',
		'{$data->oaddress}',
		'{$data->obookdate}',
		'{$data->obookservice}',
		'{$data->opostselect}',
		'{$data->ogift}',
		'{$data->ogprice}',
		'{$data->ogpricepre}',
		'{$data->ocreatedate}',
		'{$data->ouid}',
		'{$data->oprovince}',
		'{$data->ocity}',
		'{$data->oarea}'
		) ";
		$this->query ( $sql );
		//更新oid
		$id = mysql_insert_id ();
		$oid = $this->updateID ( $id );
		$sql = "update shoporder set OID = '{$oid}' where ID= '{$id}'";
		$this->query ( $sql );
		
	//	echo mysql_error();
	}
	public function updateInfo($oid, $ogid, $ogprice, $ogpricepre) {
		$sql = "update shoporder set OGID='{$ogid}',OGPRICE='{$ogprice}',OGPRICEPRE='{$ogpricepre}' where OID='{$oid}'";
		if ($this->query ( $sql )) {
			return true;
		}
	
	}

}
class userlogin extends Mysql {
	public function getOneUid($laccount) {
		$sql = "select * from userlogin where LACCOUNT = '{$laccount}'";
		$rs = $this->returnQuery ( $sql );
		if (! $rs) {
			return false;
		}
		$row = mysql_fetch_array ( $rs );
		return $row;
	
	}
}
class interact extends Mysql {
	public $id;
	public $iUid;
	public $iUser;
	public $iGid;
	public $iPic;
	public $iState;
	public $iStartDate;
	public $iEndDate;
	public $iClickCount;
	public function insert($iuid, $iuser, $igid, $ipic) {
		$iStartDate = date ( "Y-m-d" );
		$iEndDate = date ( "Y-m-d", mktime ( 0, 0, 0, date ( "m" ) + 1, date ( "d" ), date ( "Y" ) ) );
		$sql = "insert into interactive (
					IUID,
					IUSER,
					IGID,
					IPIC,
					ISTARTDATE,
					IENDDATE
		) values(
		'{$iuid}',
		'{$iuser}',
		'{$igid}',
		'{$ipic}',
		'{$iStartDate}',
		'{$iEndDate}'
		)";
		$this->query ( $sql );
	
	}
	public function getAllInfo() {
		$date = date ( 'Y-m-d' );
		$sql = "select * from interactive where IENDDATE>'{$date}'";
		$result = mysql_query ( $sql );
		$json = "";
		$data = array ();
		while ( $row = mysql_fetch_array ( $result, MYSQL_ASSOC ) ) {
			$int = new self ();
			$int->id = $row ['ID'];
			$int->iUid = $row ['IUID'];
			$int->iUser = $row ['IUSER'];
			$int->iGid = $row ['IGID'];
			$int->iPic = $row ['IPIC'];
			$int->iState = $row ['ISTATE'];
			$int->iStartDate = $row ['ISTARTDATE'];
			$int->iEndDate = $row ['IENDDATE'];
			$int->iClickCount = $row ['ICLICKCOUNT'];
			$data [] = $int;
		}
		;
		$json = json_encode ( $data );
		$json = "{" . '"interact"' . ":" . $json . "}";
		return $json;
	}
	public function getAllInfoExDate() {
		$date = date ( 'Y-m-d' );
		$sql = "select * from interactive where IENDDATE<'{$date}'";
		$result = mysql_query ( $sql );
		$json = "";
		$data = array ();
		while ( $row = mysql_fetch_array ( $result, MYSQL_ASSOC ) ) {
			$int = new self ();
			$int->id = $row ['ID'];
			$int->iUid = $row ['IUID'];
			$int->iUser = $row ['IUSER'];
			$int->iGid = $row ['IGID'];
			$int->iPic = $row ['IPIC'];
			$int->iState = $row ['ISTATE'];
			$int->iStartDate = $row ['ISTARTDATE'];
			$int->iEndDate = $row ['IENDDATE'];
			$int->iClickCount = $row ['ICLICKCOUNT'];
			$data [] = $int;
		}
		;
		$json = json_encode ( $data );
		$json = "{" . '"interact"' . ":" . $json . "}";
		return $json;
	}

}
class interactClick extends Mysql {
	public $iid;
	public $uid;
	public $createDate;
	public function upClick($id, $uid) {
		
		//interactiveclick
		date_default_timezone_set ( 'PRC' );
		$createDate = date ( 'Y-m-d' );
		$sql = "insert into interactiveclick (
		IID,
		UID,
		CREATEDATE
		) values(
		'{$id}',
		'{$uid}',
		'{$createDate}'
		)";
		$this->query ( $sql );
		
		//interact
		$sql = "update interactive set ICLICKCOUNT=ICLICKCOUNT+1  where ID='{$id}'";
		$this->query ( $sql );
	
	}
	public function upClickDel($id, $uid) {
		
		//interactiveclick
		date_default_timezone_set ( 'PRC' );
		$createDate = date ( 'Y-m-d' );
		$sql = "delete from interactiveclick where IID='{$id}' and UID='{$uid}'";
		$this->query ( $sql );
		
		//interact
		$sql = "update interactive set ICLICKCOUNT=ICLICKCOUNT-1  where ID='{$id}'";
		$this->query ( $sql );
	
	}
	public function getAllInfo($uid) {
		$sql = "select * from interactiveclick where UID='{$uid}'";
		$result = mysql_query ( $sql );
		$json = "";
		$data = array ();
		while ( $row = mysql_fetch_array ( $result, MYSQL_ASSOC ) ) {
			$int = new self ();
			$int->iid = $row ['IID'];
			$int->uid = $row ['UID'];
			$int->createDate = $row ['CREATEDATE'];
			$data [] = $int;
		}
		;
		$json = json_encode ( $data );
		$json = "{" . '"interactClick"' . ":" . $json . "}";
		return $json;
	}

}
class usize extends Mysql{
	public function getAllInfo(){
		$sql = "select * from usize";
		return $this->getAll ( $sql );
	}
	public function deleteOne($usid) {
		$sql = "delete from usize where USID='$usid'";
		if ($this->returnQuery ( $sql )) {
			return true;
		}
		return false;
	}
	public function updateOne($usid,$infohight,$infochest,$infowaist,$infoshoulder,$infoneck,$infoarm){
		$sql="update usize set INFOHIGHT='$infohight',INFOCHEST='$infochest',INFOWAIST='$infowaist',INFOSHOULDER='$infoshoulder',INFONECK='$infoneck',INFOARM='$infoarm' where USID='$usid'";
		if ($this->query ( $sql )) {
			return true;
		}
	}
}

//$i = new interact();
//$i->insert();
//$order= new shopOrder ();
//echo "<pre>";
//print_r($order->getAllInfo());
//echo mysql_error();
//$user = new user ();
//echo "<pre>";
//print_r($user->getAll("select * from user where UKIND=0"));


?>