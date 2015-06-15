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
	 * ��������ӵ�������Ϣ����������Ϣ��
	 * Enter description here ...
	 */
	public function insertChannelInfo($arr){		
		try {							
			$now=date("Y-m-d H:i:s");		
			$retInfo = $this->STO->addObject(array(    
		           'channel_name' =>$arr['channel'],
                   'coupon_id'     => $arr['couponId'],
		           'coupon_name'   => $arr['couponName'],
		           'isvalid'  => 1,
                   'insertdate' => $now,
                   'updatedate' => $now
		      ));	
		
		}
		catch (Exception $e) {
			//�����쳣��ɾ��redis�����еĶ�Ӧ���
			$errorNum = $this->$STO->getErrorNum();
			$_retMsg = $this->$STO->getErrorInfo().$e->getMessage();
			$_retValue = genRetCode($errorNum);
			interface_log(ERROR, $retValue, $retMsg);
			return false;
		}
	
		return $retInfo;
		
		
	}
	
	
	/**
	 * ��ѯ�û�������Ч���Ż�ȯ
	 * Enter description here ...
	 */
	public function queryMyCoupon($arr){
		$data=array();
		try {			
			$storeWxId = $arr['storeWxId'];
			$username = $arr['username'];	
				
			$now=date("Y-m-d H:i:s");
			
			$data = $this->STO->getObject(
			array ("_field"=>"id,username,storename,money,couponname,coupontype,left(validdate,10) as validdate",
			"_where" => " storename='" . $storeWxId .
		           "' and username='" . $username . 
		           "' and isvalid='" . 1 .
			       "' and validdate>='" . $now .
		           "' and useddate is  null" .
		           ""));
				
		
		}
		catch (Exception $e) {
			//�����쳣��ɾ��redis�����еĶ�Ӧ���
			$errorNum = $this->$STO->getErrorNum();
			$_retMsg = $this->$STO->getErrorInfo().$e->getMessage();
			$_retValue = genRetCode($errorNum);
			interface_log(ERROR, $retValue, $retMsg);
			return $data;
		}
	
		return $data;
		
		
	}
	

	/**
	 * ���Ż�ȯʹ����� ���дwx_usercoupon��ݱ�
	 * Enter description here ...
	 */
	public function updateConsumedCoupon(&$arr){
		try {			
			$storeWxId = $arr['storeWxId'];
			$username = $arr['username'];	
			$code = $arr['code'];
			$couponId = $arr['couponId'];	
				
			$now=date("Y-m-d H:i:s");
			
			$updateOk = $this->STO->updateObject(
			  array(
			        "activecode"=>$code,
			        "isvalid"=>CODE_USED,
			        "useddate"=>$now,
			        "updatedate"=>$now
			        ),
			  array(
			        "id"=>$couponId,
			        "isvalid"=>CODE_NOT_USED
			        )
			);
				
		
		}
		catch (Exception $e) {
			//�����쳣��ɾ��redis�����еĶ�Ӧ���
			$errorNum = $this->$STO->getErrorNum();
			$_retMsg = $this->$STO->getErrorInfo().$e->getMessage();
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