<?php
/*
 * 配置文件：
 *	array(
 *		......
 *		'components'=>array(
 *			......
 *			'db'=>array(
 *				'class'=>'UDbConnection',
 *				'masterConfig'=> array(
 *        			'connectionString' => 'mysql:host=127.0.0.1;dbname=testdb;port=3306', //Master数据库DSN
 *        			"username"         => 用户名,
 *        			"password"         => 密码,
 *    			);
 * 				'slaveConfig' = array(
 *        			'connectionString' => 'mysql:host=127.0.0.2;dbname=testdb;port=3306|
 *								 mysql:host=127.0.0.3;dbname=testdb;port=3306|', //Slave1数据库DSN|Slave2数据库DSN|...
 *        			"username"         => 用户名,
 *        			"password"         => 密码,
 *    			);
 *				'charset'=>'utf8',
 *				'tablePrefix'=>'web_', 
 *			),
 *		),
 *	)
*/

class UDbConnection extends CApplicationComponent
{
	/**
     * 主数据库配置信息
     */
    public $masterConfig = array();
	/**
     * 从数据库配置信息
     */
    public $slaveConfig  = array();
	/**
     * 初始化的时候是否要连接到数据库
     */
    public $autoConnect = false;
	/**
     * 是否查询出错的时候终止脚本执行
     */
    public $isExit = false;
	/**
	 * 字符编码
	 */
	public $charset = 'utf8';
	/**
	 * 表前缀  
	 */
	public $tablePrefix = '';
	
	
	/**
     * Master数据库对应的CDbConnection对象
     */
    private $_masterConnection = null;
    /**
     * Slave数据库对应的CDbConnection对象
     */
    private $_slaveConnections = array();

	
	/**
     * 初始化函数
     *
     */
    public function init()
    {
		parent::init();
       //自动初始化连接（一般不推荐）
        if ($this->autoConnect)
		{
            $this->getMasterConnection();
            $this->getSlaveConnection();
        }
		register_shutdown_function(array($this,'close'));
    }
	
	/**
     * 构造函数
     * @return void
     */
    public function __construct($masterConfig=array(), $slaveConfig=array())
	{
		$this->masterConfig = $masterConfig;
		$this->slaveConfig  = $slaveConfig;
		register_shutdown_function(array($this,'close'));
    }
	
	/**
	 * 预处理语句
	 * @param string $sql
	 * @param boolean $isMaster 是否指定使用主库
	 * @return CDbCommand
	 * 示例：
	 * $connection = new UDbConnection($masterConfig, $slaveConfig)
	 * $command = $connection->prepare($sqlStatement,$isMaster);
	 * //or 
	 * $command = Yii::app()->db->prepare($sqlStatement,$isMaster);
	 *  
	 * $command->bindParam($name1,$value1);
	 * //or
	 * $command->bindValue($name1,$value1);
	 * 
	 * $command->execute();
	 * //or
	 * $command->query();
	 * //or
	 * $command->queryAll();
	 * //or
	 * $command->queryRow();
	 * ...............
	 */
	public function prepare($sql, $isMaster=false)
	{
		return $this->getConnection($sql, $isMaster)->createCommand($sql);
	}

	/**
	 * 执行sql语句，仅返回影响的行数
	 * 此方法用于执行除select以外的所有sql，故强制使用主库
	 * @param string $sql
	 * @return integer number of rows affected by the execution.
	*/
	public function execute($sql)
	{
		return $this->getMasterConnection()->createCommand($sql)->execute();
	}
	
	/**
	 * 执行sql查询语句
	 * @param string $sql
	 * @param boolean $isMaster
	 * @return CDbDataReader the reader object for fetching the query result
	 */
	public function query($sql, $isMaster=false) 
	{
		return $this->getConnection($sql, $isMaster)->createCommand($sql)->query();
		
	}
	
	
	/**
	 * 执行sql查询语句并返回所有行（二维数组）
	 * @param string $sql
	 * @param blooean $isMaster
	 * @return array
	 */
	public function queryAll($sql, $isMaster=false) 
	{
		return $this->getConnection($sql, $isMaster)->createCommand($sql)->queryAll();
	}
	
	/**
	 * 获取一行记录（一维数组）
	 * @param string $sql
	 * @param blooean $isMaster
	 * @return array
	 */
	public function getRow($sql, $isMaster=false) 
	{
		return $this->getConnection($sql, $isMaster)->createCommand($sql)->queryRow();
	}
	
	/**
	 * 获取某一个字段的值
	 * @param string $sql
	 * @param blooean $isMaster
	 * @return value
	 */
	public function queryScalar($sql, $isMaster=false)
	{
		return $this->getConnection($sql, $isMaster)->createCommand($sql)->queryScalar();
	}
	
	/**
	 * 获取一列记录（一维数组）
	 * @param string $sql
	 * @param blooean $isMaster
	 * @return array
	 */
	public function queryColumn($sql, $isMaster=false)
	{
		return $this->getConnection($sql, $isMaster)->createCommand($sql)->queryColumn();
	}
	
	/**
	 * 插入记录
	 * The method will properly escape the column names, and bind the values to be inserted.
	 * @param string $table the table that new rows will be inserted into.
	 * @param array $columns the column data (name=>value) to be inserted into the table.
	 * @return integer number of rows affected by the execution.
	 */
	public function insert($table, $columns)
	{
		return $this->getMasterConnection()->createCommand()->insert($table, $columns);
	}
	
	/**
	 * 更新记录
	 * The method will properly escape the column names and bind the values to be updated.
	 * @param string $table the table to be updated.
	 * @param array $columns the column data (name=>value) to be updated.
	 * @param mixed $conditions the conditions that will be put in the WHERE part. Please
	 * refer to {@link where} on how to specify conditions.
	 * @param array $params the parameters to be bound to the query.
	 * @return integer number of rows affected by the execution.
	 */
	public function update($table, $columns, $conditions='', $params=array())
	{
		return $this->getMasterConnection()->createCommand()->update($table, $columns, $conditions='', $params=array());
	}
	
	/**
	 * 删除记录
	 * @param string $table the table where the data will be deleted from.
	 * @param mixed $conditions the conditions that will be put in the WHERE part. Please
	 * refer to {@link where} on how to specify conditions.
	 * @param array $params the parameters to be bound to the query.
	 * @return integer number of rows affected by the execution.
	 */
	public function delete($table, $conditions='', $params=array())
	{
		return $this->getMasterConnection()->createCommand()->delete($table, $conditions='', $params=array());
	}
	
	/**
	 * 获取LastInsertID 
	 * @return integer
	 */

	public function getLastInsertID() 
	{
		return $this->getMasterConnection()->getLastInsertID();
	}
	
	/**
	 * 开始事务
	 * @return CDbTransaction the transaction initiated
	 * 示例：
	 *  Yii::app()->db->beginTransaction();
	 *  try
	 *  {
	 *     Yii::app()->db->execute($sql1);
	 *     Yii::app()->db->execute($sql2);
	 *     //.... 其他的SQL操作
	 *     Yii::app()->db->commit();
	 *  }
	 *  catch(Exception $e)
	 *  {
	 *     Yii::app()->db->rollBack();
	 *  }
	 */
	public function beginTransaction()
	{
		$this->getMasterConnection();
		return $this->_masterConnection->beginTransaction();
	}
	
	/**
	 * 提交事务
	 * @return null
	 */
	public function commit()
	{
		$this->getMasterConnection();
		$this->_masterConnection->getPdoInstance()->commit();
	}
	
	/**
	 * 回滚事务
	 * @return null
	 */
	public function rollBack()
	{
		$this->getMasterConnection();
		$this->_masterConnection->getPdoInstance()->rollBack();
	}
	
	/**
     * 关闭数据库连接
	 * @param CDbConnection $connection
	 * @param boolean $closeAll
	 * @return boolean
     */
    public function close($connection=null, $closeAll=true)
	{
        //关闭指定数据库连接
        if ($connection instanceof CDbConnection)
		{
            $connection->active = false;
            $connection = null;
        }
        //关闭所有数据库连接
        if (!$connection && $closeAll)
		{
            if ($this->_masterConnection && $this->_masterConnection instanceof CDbConnection)
			{
                $this->_masterConnection->active = false;
                $this->_masterConnection = null;
            }
            if (is_array($this->_slaveConnections) && !empty($this->_slaveConnections))
			{
                foreach($this->_slaveConnections as $connection)
				{
                    if ($connection && $connection instanceof CDbConnection)
					{
                        $connection->active = false;
                    }
                }
                $this->_slaveConnections = array();
            }
        }
        return true;
    }
	
	/**
     * 获取Master主库连接对象
	 * @return CDbConnection
     */
    public function getMasterConnection()
	{
        //判断是否已经连接
        if ($this->_masterConnection instanceof CDbConnection) 
		{
			if (!$this->_masterConnection->getActive()) 
			{
				$this->_masterConnection->active = true;
			}
			return $this->_masterConnection;

		}
        //没有连接则自行处理
		try
		{
		
			$this->_masterConnection = new CDbConnection($this->masterConfig['connectionString'], 
											$this->masterConfig['username'], 
											$this->masterConfig['password']);
			$this->_masterConnection->charset = $this->charset;
			$this->_masterConnection->tablePrefix = $this->tablePrefix;
			$this->_masterConnection->active =true;
		}
		catch(CDbException $e)
		{
			Yii::log($e->getMessage(),CLogger::LEVEL_ERROR,'exception.CDbException');
			throw new CDbException(Yii::t('yii','CDbConnection failed to open the masterDB connection.'),(int)$e->getCode(),$e->errorInfo);
		}
        return $this->_masterConnection;
    }

    /**
     * 获取Slave从库连接
	 * @return CDbConnection
     */
    public function getSlaveConnection()
	{
        //如果有可用的Slave连接，随机挑选一台Slave
        if (!empty($this->_slaveConnections)) 
		{
            $key = array_rand($this->_slaveConnections);
			if (!$this->_slaveConnections[$key]->getActive())  
			{
				try
				{
					$this->_slaveConnections[$key]->active = true;
				}
				catch(CDbException $e)
				{
					unset($this->_slaveConnections[$key]);
					return $this->getSlaveConnection();
				}
			}
			return $this->_slaveConnections[$key];
        }
        //连接到所有Slave数据库，如果没有可用的Slave机则调用Master
        $arrDSN = explode("|", $this->slaveConfig['connectionString']);
        if (!is_array($arrDSN) || empty($arrDSN))
		{
            return $this->getMasterConnection();
        }
        foreach($arrDSN as $tmpDSN)
		{
		    try
			{
				$connection = new CDbConnection($tmpDSN, $this->slaveConfig['username'], $this->slaveConfig['password']);
				$connection->charset = $this->charset;
				$connection->tablePrefix = $this->tablePrefix;
				$connection->active =true;
			}
			catch(CDbException $e)
			{
				Yii::log($e->getMessage(),CLogger::LEVEL_ERROR,'exception.CDbException');
				continue;
			}
			$this->_slaveConnections[] = $connection;
        }
        
        //如果没有一台可用的Slave则调用Master
        if (empty($this->_slaveConnections))
		{
            return $this->getMasterConnection();
        }
        //随机在已连接的Slave机中选择一台
        $key = array_rand($this->_slaveConnections);
        if ($this->_slaveConnections[$key]->active)
		{
            return $this->_slaveConnections[$key];
        }
        //如果选择的slave机器是无效的，并且可用的slave机器大于一台则循环遍历所有能用的slave机器
		unset($this->_slaveConnections[$key]);
        if (count($this->_slaveConnections) > 1)
		{
            foreach($this->_slaveConnections as $connection)
			{
                if ($connection->active)
				{
                    return $connection;
                }
            }
        }
        //如果没有可用的Slave连接，则继续使用Master连接
        return $this->getMasterConnection();
    }
	
	/**
	 * 根据sql获取数据库连接
	 * @param string $sql
	 * @return CDbConnection
	*/
	private function getConnection($sql,$isMaster=false)
	{
		if($isMaster)
		{
			return $this->getMasterConnection();
		}
		$temp = explode(" ", ltrim($sql));	
		$optType = trim(strtolower(array_shift($temp)));
		unset($temp);
        if ($optType!="select")
		{
            return $this->getMasterConnection();
        } 
		else 
		{
            return $this->getSlaveConnection();
        }
	}
}
