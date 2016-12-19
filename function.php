<?php

class ChatSQL
{

private $dsn ='mysql:dbname=ChatDB;host=127.0.0.1';
private $user='root';
private $pw  ='H@chiouji1';
private $dbh;
private $sth;


public function __construct(){
  $this->Login();
}

public function Login(){
  if(empty($this->dbh) === false)return;
  try
  {
    $this->dbh = new PDO($this->dsn,$this->user,$this->pw);
    $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
  catch(PDOException $e)
  {
    exit();
  }
}

public function isNull(){
  if(empty($this->dbh))return true;
  if(empty($this->sth))return true;
  return false;
}

public function CreateTable(){

  if($this->isNull()){
    print('Create Table Error.');
    exit();
  }

  //CREATE DATABASE ChatDB;

  try
  {
    //ユーザーテーブル作成
    $this->TranExecute('
    CREATE TABLE IF NOT EXISTS `ChatDB`.`User` (
      `id` INT NOT NULL AUTO_INCREMENT,
      `loginid` VARCHAR(32) NOT NULL,
      `password` VARCHAR(16) NOT NULL,
      `despname` VARCHAR(32) NOT NULL,
      `del_flag` TINYINT(1) NOT NULL DEFAULT 0,
      `lastlogin` DATETIME NOT NULL DEFAULT now(),
      PRIMARY KEY (`id`),
      UNIQUE INDEX `loginid_UNIQUE` (`loginid` ASC))
    ENGINE = InnoDB
    ');
    //チャットテーブル作成
    $this->TranExecute('
    CREATE TABLE IF NOT EXISTS `ChatDB`.`Chat` (
      `id` INT NOT NULL AUTO_INCREMENT,
      `user_id` INT NULL,
      `text` VARCHAR(256) NULL,
      `stamp_id` INT NULL DEFAULT NULL,
      `datetime` DATETIME NOT NULL DEFAULT now(),
      `del_flag` TINYINT(1) NOT NULL DEFAULT 0,
      PRIMARY KEY (`id`))
    ENGINE = InnoDB
    ');
  }
  catch(PDOException $e)
  {
      print('SQL CreateTableError');
  }
}

public function TranExecute($sql){
  if(empty($this->dbh))return;
  try
  {
    $this->dbh->beginTransaction();

    $this->sth = $this->dbh->prepare($sql);
    $this->sth->execute();

    $this->dbh->commit();
  }
  catch(PDOException $e)
  {
    $this->dbh->rollback();
    exit();
  }
}

public function Execute($sql){
  if(empty($this->dbh))return;
  try
  {
    $this->sth = $this->dbh->prepare($sql);
    $this->sth->execute();
  }
  catch(PDOException $e)
  {
    $this->dbh->rollback();
    exit();
  }
}

//取得したデータが消えるから使えない
// public function Count(){
//   if($this->isNull()){
//     return 0;
//   }
//   return $this->sth->fetchColumn();
// }

public function Fetch(){
  if($this->isNull()){
    return NULL;
  }
  if(($buff = $this->sth->fetch())!==false){
    return $buff;
  }
  return NULL;
}
}

class User{

  public $password;
  public $loginid;
  public $name = NULL;
  public $id = NULL;

  function __destruct() {
    //$sql = new ChatSQL();
  }

  public function Login($id, $pass){
    if(empty ($id) || empty($pass)){
          return 'Plese input your id and password.';
    }

    $sql = new ChatSQL();

    $select = 'select id,password,despname from User';
    $where = ' where loginid = "'.$id.'"';
    $sql->Execute($select.$where);

    //データが消える
    // if($sql->Count() === 0){
    //   return 'Not found id.';
    // }
    $buff = $sql->Fetch();
    if(empty($buff)){
      return 'Not found id.';
    }

    if($buff['password'] != $pass){
      return 'Password is incorrect';
    }

    $this->password = $pass;
    $this->loginid = $id;
    $this->name = $buff['despname'];
    $this->id = $buff['id'];

    return "";
  }

  public function Chat($text){
    if(is_null($this->id)){
          return false;
    }
    if(empty($text)){
          return false;
    }

    $sql = new ChatSQL();

    $select = 'insert into Chat( user_id, text)';
    $val = ' values("'.$id.'","'.$text.'")';
    $sql->TranExecute($select.$val);

    return true;
  }
  public function Stamp($stampid){
    if(is_null($this->id)){
          return false;
    }
    if(is_null($stampid)){
          return false;
    }

    $sql = new ChatSQL();

    $select = 'insert into Chat( user_id, stamp_id)';
    $val = ' values('.$id.','.$stampid.')';
    $sql->TranExecute($select.$val);

    return true;
  }

  public function DeleteChat($chatid){
    if(is_null($this->id)){
          return false;
    }
    if(empty($chatid)){
          return false;
    }

    $sql = new ChatSQL();

    $select = 'delete Chat';
    $where = ' where id = '.$chatid;
    $sql->TranExecute($select.$where);

    return true;
  }

}
 ?>
