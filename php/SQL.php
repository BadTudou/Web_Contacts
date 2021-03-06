<?php
/*
	Copyright © BadTudou, 2016
	All rights reserved

	Name	:	SQL.php
	By		:	BadTudu
	Date	:	2016年4月23日13:31:05
	Note	:	SQL操作
*/
class MYSQL
{
	protected $m_host;
	protected $m_port;
	protected $m_user;
	protected $m_pwd;
	public $m_resource;


	public function __construct()
	{
		$this->m_host = '5721c54946174.gz.cdb.myqcloud.com';
		$this->m_port = '11869';
		$this->m_user = 'root';
		$this->m_pwd  = 'RchD3PvU5TA2UtU4';
	}

	public function __destruct()
	{
		if ($this->GetConnectState())
		{
			mysqli_close($this->m_resource);
		}
	}

	/**
	 * [连接MYSQL服务器]
	 */
	public function connect()
	{
		$this->m_resource = mysqli_connect($this->m_host.":".$this->m_port, $this->m_user, $this->m_pwd);
		mysqli_query($this->m_resource, "set names 'UTF8'");
	}

	/**
	 * [获取连接状态]
	 * @return [bool]         [状态：已连接:true;未连接:false]
	 */
	public function getConnectState()
	{
		return is_object($this->m_resource);
	}

	/**
	 * [选择数据库]
	 * @param  string $dbname [数据库名称]
	 * @return [bool]         [状态：成功:true;失败:false]
	 */
	public function selectDatabase($dbname)
	{
		return mysqli_select_db($this->m_resource, $dbname);
	}
	
	/**
	 * [创建数据库]
	 * @param  string $dbname [数据库名称]
	 * @return [bool]         [状态：成功:true;失败:false]
	 */
	public function createDatabase($dbname)
	{
		$sqlcmd = 'CREATE DATABASE IF NOT EXISTS '.$dbname;
		return $this->executeQuery($sqlcmd);
	}

	/**
	 * [删除数据库]
	 * @param  string $dbname [数据库名称]
	 * @return [bool]         [状态：成功:true;失败:false]
	 */
	public function dropDatabase($dbname)
	{
		$sqlcmd = 'DROP DATABASE IF EXISTS '.$dbname;
		return $this->executeQuery($sqlcmd);
	}

	/**
	 * [执行查询]
	 * @param  string $sql [SQL语句]
	 * @return [bool]      [执行状态：true,成功; false,失败]
	 */
	public function executeQuery($sql)
	{
		return mysqli_query($this->m_resource, $sql);
		//return mysqli_error($this->m_resource) == ''?true:false;
	}
	
}
