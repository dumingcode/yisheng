<?php
/**
 * ����˾���� ��Ҫ�漰 ��ӡ�ɾ���޸�����
 */
require_once dirname(__FILE__) . '/../common/Common.php';
class YiShengManager{
	
    private $STO;
    
	public function  initialize(){
		$this->STO = new SingleTableOperation();
		$this->STO->setTableName("ys_channelinfo"); //�˱�洢����������Ϣ
	}
	
   /**
	 * 插入新增的渠道信息
	 * Enter description here ...
	 */
	public function insertChannelInfo($arr){		
		try {							
			$now=date("Y-m-d H:i:s");		
			$retInfo = $this->STO->addObject(array(    
		           'channel_name' =>$arr['channel'],
                   'coupon_id'     => $arr['couponId'],
		           'coupon_name'   => $arr['couponName'],
		           'isvalid'  => YS_IS_VALID,
                   'insertdate' => $now,
                   'updatedate' => $now
		      ));	
		
		}
		catch (Exception $e) {
			//�����쳣��ɾ��redis�����еĶ�Ӧ���
			$errorNum = $this->STO->getErrorNum();
			$_retMsg = $this->STO->getErrorInfo().$e->getMessage();
			$_retValue = genRetCode($errorNum);
			interface_log(ERROR, $retValue, $retMsg);
			return false;
		}
	
		return $retInfo;
		
		
	}
	
	
	/**
	 * 返回有效的渠道信息
	 * Enter description here ...
	 */
	public function queryChannelInfo(){
		try {							
			$data = $this->STO->getObject(
			array ("_field"=>"channel_id,channel_name,coupon_id,coupon_name",
			"_where" => 'isvalid=' . YS_IS_VALID));
				
		
		}
		catch (Exception $e) {
			$errorNum = $this->STO->getErrorNum();
			$_retMsg = $this->STO->getErrorInfo().$e->getMessage();
			$_retValue = genRetCode($errorNum);
			interface_log(ERROR, $retValue, $retMsg);
			return $data;
		}
	
		return $data;
		
		
	}
	

	/**
	 * 删除渠道信息 实质上是将isvalid 由1变为0
	 * Enter description here ...
	 */
	public function delChannelInfo(&$arr){
		try {			
			$channelId = $arr['channelId'];
			$now=date("Y-m-d H:i:s");			
			$updateOk = $this->STO->updateObject(
			  array(
			        "isvalid"=>YS_NOT_VALID,
			        "updatedate"=>$now
			        ),
			  array(
			        "channel_id"=>$channelId,
			        "isvalid"=>YS_IS_VALID
			        )
			);
				
		
		}
		catch (Exception $e) {
			//�����쳣��ɾ��redis�����еĶ�Ӧ���
			$errorNum = $this->STO->getErrorNum();
			$_retMsg = $this->STO->getErrorInfo().$e->getMessage();
			$_retValue = genRetCode($errorNum);
			interface_log(ERROR, $retValue, $retMsg);
			return false;
		}
	
		return $updateOk;
		
		
	}
	
	
	
	
	
	
	
	
	/**
	 * ʹ�ü����룺������ļ������δʹ�ö���ɾ��
	 * ���ҽ��������ʹ��ʱ����뵽��ʹ�ö�����
	 * Ȼ�����mysql��ݿ��е�ʵ���
	 * Enter description here ...
	 * @param unknown_type $code
	 * @param unknown_type $userid
	 * @return ������֤��Ϣ
	 */
	public function consume(&$arr){
		$code = $arr['code'];
		$storename = $arr['storeWxId'];
		//δʹ�õļ����뼯��
		$unUsedCodes = $storename . ':' .'codes';
		//��ʹ�õļ����뼯��
		$usedCodes = $storename . ':' .'usedcodes';
		
		/*-------------------------------------------------------------*/
        /*	$updateOk = $this->updateConsumedCoupon($arr);
			if($updateOk){
				interface_log(DEBUG, EC_OTHER, 'update true');
			}else{
				interface_log(DEBUG, EC_OTHER, 'update false');
			}
		    return $updateOk;
		    
		 */   
		/*-------------------------------------------------------------*/    
		
		$this->redis->watch($code);
		if($this->isCodeValid($arr)){			
			//��������Ҫ�ڵ��һ���ť����
			//��ִ���Ƿ�ɹ��ı�ǩ����Ӧ�ü��ж� �Ƿ�Ϊ��
			
			interface_log(DEBUG, EC_OTHER, 'redis before update');
			$ret = $this->redis->multi(Redis::MULTI)
			->sRem($unUsedCodes ,$code)
			->sAdd($usedCodes , $code)
			->exec();
			
			interface_log(DEBUG, EC_OTHER, 'redis after update');
			
			if($ret[0]==1 && $ret[1]==1){ 
				$this->retMsg = COUPON_HINT_CONSUME_SUCCESS;
				interface_log(DEBUG, EC_OTHER, $this->retMsg);
				//return true;
			}
			else{
				$this->retMsg = COUPON_HINT_CONSUME_FAILED;
				interface_log(DEBUG, EC_OTHER, $ret.'  '.$this->retMsg);
			}						
			
			//��д�û�����ȯ�� ������ȯʱ�� isvalid�ֶ� activecode�ֶ� useddate
			$updateOk = $this->updateConsumedCoupon($arr);
			if($updateOk){
				interface_log(DEBUG, EC_OTHER, 'update true');
			}else{
				interface_log(DEBUG, EC_OTHER, 'update false');
			}

		 //��д�ɹ���ִ�к���
				
		}
//		else{
//			$this->isCodeUsed();
//		}
		return $updateOk;
			
	}
	
	
	
	
	
	
}




?>