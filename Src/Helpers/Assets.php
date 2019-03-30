<?php 
namespace Helper;


class Assets{
	
	protected $app;
	public function __construct($app){
		
		$this->app = $app; 
		
	}
	
	public function urlRender(){

		$script = "<script type='text/javascript'>
					var rootUrl = '".$this->app['baseUrl']."';

					var	theFormatDate='DD/MM/YYYY';
					var	theFormatTime='h:mm a';
					</script>
				";
		return $script;
	}
	
	public function recaptcha($response){
		
		$payLoad = [];
		
		if(!$this->app['helper']('Utility')->notEmpty($response)){
			
			$payLoad = ['status'=>'error','message'=>'Some required fields are empty.'];
			
		}else{
				
			$res = $this->app['helper']('OutgoingRequest')->postRequest($this->app['config']['parameters']['googleCaptchaUrl'],[],['secret' => $this->app['config']['parameters']['googleCaptchaSecret'],'response' => $response]);
			
			if($res['success'] === true){
				
				$payLoad = ['status'=>'success','message'=>'Captcha validated.'];
				
			}else{
				
				$payLoad = ['status'=>'error','message'=>'Captcha not validated.'];
				
			}
			
			return $payLoad;
			
		}


	}
}