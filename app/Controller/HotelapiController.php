<?php

App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AppController', 'Controller');
//App::import('Vendor', 'payu');
App::uses('CakeEmail', 'Network/Email');
App::uses('HttpSocket', 'Network/Http');
App::uses('Xml', 'Utility');
App::uses('Hash', 'Utility');
// ob_start();

App::uses('AppController', 'Controller');


class HotelapiController extends AppController 
{

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $components = array('Session','Paginator');
	public $hepler = array('Session','Paginator', 'Form');

	public $layout = 'frontend';

	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allow('getUserIP','CurlRequest','CheckJson','Authenticate','Logout','CountryList','GetAgencyBalance','DestinationCityList','TopDestinationList','GetHotelResult','GetHotelInfo','GetHotelRoom','BlockRoom','Book','GenerateVoucher','GetBookingDetail','SendChangeRequest','GetChangeRequestStatus','apitestform');
	}

	public function apitestform($value='')
	{
		
	}

	/*Getting current user ip address*/
	public function getUserIP()
	{
	    $client  = @$_SERVER['HTTP_CLIENT_IP'];
	    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
	    $remote  = $_SERVER['REMOTE_ADDR'];

	    if(filter_var($client, FILTER_VALIDATE_IP))
	    {
	        $ip = $client;
	    }
	    elseif(filter_var($forward, FILTER_VALIDATE_IP))
	    {
	        $ip = $forward;
	    }
	    else
	    {
	        $ip = $remote;
	    }

	    return $ip;
	}

	/*Common Curl Request for all api's*/
	public function CurlRequest($url, $data)
	{

		$ch = curl_init($url);

		$payload = json_encode($data);
		// pr($payload);die();


		curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);

		$result = curl_exec($ch);

		/*if request has error return erreor report*/
		if($result === false)
		{
		    echo 'Curl error: ' . curl_error($ch);
		}

		curl_close($ch);

		die();
	}

	/*Checking if post request having data type JSON or Not*/
	public function CheckJson($jsondata='')
	{
		$dataArray = [];

		if ( !empty($jsondata) ) 
		{
			// $jsonData = $jsondata;
			// $dataArray = json_decode(json_encode($jsonData), true);
			// pr($dataArray);die();
			return $dataArray;
		}else{
			echo 'error : Please send data in Json format only.';
		}
			die();

	}

	/*Authenticate Api to get Token Id*/
	public function Authenticate($value='')
	{
		$dataArray = $this->request->data;

		// pr($reqData);die();
		// $dataArray = $this->CheckJson($this->request->input('json_decode'));
		// $dataArray = $this->CheckJson($reqData);

		$url = "http://api.tektravels.com/SharedServices/SharedData.svc/rest/Authenticate";

		$this->CurlRequest($url, $dataArray);
		die();
	}


	/*
		Logout method can be used to kill any existing token (session), forecefully. Once the session is killed, the authenticate method needs to be called again and the updated Token ID needs to be passed in every subsequent request.
	*/
	public function Logout()
	{

		// $dataArray = $this->CheckJson($this->request->input('json_decode'));
		$dataArray = $this->request->data;

		$url = "http://api.tektravels.com/SharedServices/SharedData.svc/rest/Logout";

		$this->CurlRequest($url, $dataArray);
		
		die();
	}

	/*This method is used to get list of Countries where an agent can request for hotels.*/
	public function CountryList()
	{

		// $dataArray = $this->CheckJson($this->request->input('json_decode'));
		$dataArray = $this->request->data;

		$url = "http://api.tektravels.com/SharedServices/SharedData.svc/rest/CountryList";

		$this->CurlRequest($url, $dataArray);

		die();

	}

	/*GetAgencyBalance method can be used to know the Agency Balance in TBO Account.*/
	public function GetAgencyBalance()
	{
		// $dataArray = $this->CheckJson($this->request->input('json_decode'));
		$dataArray = $this->request->data;

		$url = "http://api.tektravels.com/SharedServices/SharedData.svc/rest/GetAgencyBalance";

		$this->CurlRequest($url, $dataArray);

		die();
	}



	/*This method will provide all the supported destinations (List of cities) in a Country.*/
	public function DestinationCityList()
	{

		// $dataArray = $this->CheckJson($this->request->input('json_decode'));
		$dataArray = $this->request->data;

		$url = "http://api.tektravels.com/SharedServices/SharedData.svc/rest/DestinationCityList";

		$this->CurlRequest($url, $dataArray);

		die();
	}


	/*This method will provide all the supported destinations (List of cities) in a Country.*/
	public function TopDestinationList()
	{

		// $dataArray = $this->CheckJson($this->request->input('json_decode'));
		$dataArray = $this->request->data;

		$url = "http://api.tektravels.com/SharedServices/SharedData.svc/rest/TopDestinationList";

		$this->CurlRequest($url, $dataArray);
		
		die();
	}

	/*
		This section covers the methods involved in knowing basic availability of Hotels in a city, Hotel details, Availability of rooms and Cancellation policies to avoid any penalty.

		This method is used to search hotels available for booking in a specific city within a date range. This method checks:

		General availability of hotels in a specific city. 
		Availability based on star rating of hotels (5 star or more, 4 star or more, etc).
		Availability based on Preferred Hotel. If preferred hotel is not found then all hotels in same city will be provided in response.
		 Note:

		'RoomGuest' will repeat for multiple rooms search.
		Child age(s) is compulsory when search request includes child.
		Hotel price might vary for same Search Request with different GuestNationality.
	*/
	public function GetHotelResult()
	{

		$dataArray = $this->request->data;

		if ( !isset($dataArray['ResultCount']) ) 
		{
			unset( $dataArray['ResultCount'] );
		}
		 // $dataArray['ResultCount'] = !isset($dataArray['ResultCount']) ? $dataArray['ResultCount'] 

		if ( !empty($dataArray['ChildAge'] )) 
		{
			$dataArray['RoomGuests'] = [
											"NoOfAdults" => $dataArray['NoOfAdults'], 
											"NoOfChild" =>  $dataArray['NoOfChild'], 
											"ChildAge" =>   $dataArray['ChildAge']
										];
		}else{

			$dataArray['RoomGuests'] = [
											"NoOfAdults" => $dataArray['NoOfAdults'], 
											"NoOfChild" =>  $dataArray['NoOfChild'], 
											"ChildAge" =>   ''
										];
		}


		unset($dataArray['NoOfAdults'], $dataArray['NoOfChild'], $dataArray['ChildAge']);

		$dataArray['RoomGuests'] =  json_decode(json_encode($dataArray['RoomGuests']), TRUE); 
		//json_encode($dataArray['RoomGuests']);
		// pr($dataArray);die();


		$url = "http://api.tektravels.com/BookingEngineService_Hotel/hotelservice.svc/rest/GetHotelResult/";

		$this->CurlRequest($url, $dataArray);
		
		die();
	}

	/*
		This method is used to request for hotel descriptive content information based on TraceId, ResultIndex and HotelCode. HotelDetailsResponse consist of the Hotel images, facilities, attractions, amenities and other basic details of the hotel.
	*/
	public function GetHotelInfo()
	{

		$dataArray = $this->request->data;

		$url = "http://api.tektravels.com/BookingEngineService_Hotel/hotelservice.svc/rest/GetHotelInfo/";

		$this->CurlRequest($url, $dataArray);
		
		die();
	}


	/*
		This method is used to request room details of a particular hotel based on ‘TraceId’, ‘ResultIndex’ and ‘HotelCode’. RoomDetailsResponse consists of Amenities, Bed Type details, refined cancellation policies and other details of the hotel rooms. It also provides room combination details.
	*/
	public function GetHotelRoom()
	{

		$dataArray = $this->request->data;

		$url = "http://api.tektravels.com/BookingEngineService_Hotel/hotelservice.svc/rest/GetHotelRoom/";

		$this->CurlRequest($url, $dataArray);
		
		die();
	}


	/*
		BlockRoom method is used to get the updated prices and cancellation policies for the selected rooms before proceeding with the hotel booking. Block Room will also get the norms, if any.

		This method should preferably be called before taking guest details from the client, so that in case of any price change a proper intimation can be provided.
		In case of Price change or Cancellation Policy change, you will get new price and/or new cancellation policy in the BlockRoom response with IsPriceChanged node and/or IsCancellationPolicyChanged node set as true.
		The price comparison is to be made at the client's end, and BlockRoom request needs to be sent again with the updated price and/ or updated cancellation policy.
	*/
	public function BlockRoom()
	{

		$dataArray = $this->request->data;
		
		$dataArray['Price'] = [
								"CurrencyCode" 				=> 	 $dataArray['CurrencyCode'], 
								"RoomPrice" 				=>   $dataArray['RoomPrice'], 
								"Tax" 						=>   $dataArray['Tax'],
								"ExtraGuestCharge" 			=>   $dataArray['ExtraGuestCharge'],
								"ChildCharge" 				=>   $dataArray['ChildCharge'],
								"OtherCharges" 				=>   $dataArray['OtherCharges'],
								"Discount" 					=>   $dataArray['Discount'],
								"PublishedPrice" 			=>   $dataArray['PublishedPrice'],
								"PublishedPriceRoundedOff" 	=>   $dataArray['PublishedPriceRoundedOff'],
								"OfferedPrice" 				=>   $dataArray['OfferedPrice'],
								"OfferedPriceRoundedOff" 	=>   $dataArray['OfferedPriceRoundedOff'],
								"AgentCommission" 			=>   $dataArray['AgentCommission'],
								"AgentMarkUp" 				=>   $dataArray['AgentMarkUp'],
								"ServiceTax" 				=>   $dataArray['ServiceTax'],
								"TDS" 						=>   $dataArray['TDS']
							];

		$dataArray['Price'] =  json_decode(json_encode($dataArray['Price']), TRUE); 


		// $dataArray['Price'] = $dataArray['Price'];

		$dataArray['HotelRoomsDetails'] = [

											"RoomIndex" 		=> $dataArray['RoomIndex'],
											"RoomTypeCode" 		=> $dataArray['RoomTypeCode'],
											"RoomTypeName" 		=> $dataArray['RoomTypeName'],
											"RatePlanCode" 		=> $dataArray['RatePlanCode'],
											"BedTypeCode" 		=> $dataArray['BedTypeCode'],
											"SmokingPreference" => $dataArray['SmokingPreference'],
											"Supplements" 		=> $dataArray['Supplements'],
											"Price" 			=> $dataArray['Price']
										];

		$dataArray['HotelRoomsDetails'] = json_decode(json_encode($dataArray['HotelRoomsDetails']), TRUE); 


		unset(
				$dataArray['CurrencyCode'],
				$dataArray['RoomPrice'],  
				$dataArray['Tax'],
				$dataArray['ExtraGuestCharge'],
				$dataArray['ChildCharge'],
				$dataArray['OtherCharges'],
				$dataArray['Discount'],
				$dataArray['PublishedPrice'],								
				$dataArray['PublishedPriceRoundedOff'],
				$dataArray['OfferedPrice'],
				$dataArray['OfferedPriceRoundedOff'],
				$dataArray['AgentCommission'],
				$dataArray['AgentMarkUp'],
				$dataArray['ServiceTax'],
				$dataArray['TDS'],

				$dataArray['RoomIndex'],
				$dataArray['RoomTypeCode'],
				$dataArray['RoomTypeName'],
				$dataArray['RatePlanCode'],
				$dataArray['BedTypeCode'],
				$dataArray['SmokingPreference'],
				$dataArray['Supplements'],
				$dataArray['Price'] 

			);

		// pr($dataArray);die();
		// $dataArray['RoomGuests'] = json_encode($dataArray['RoomGuests'], JSON_FORCE_OBJECT);

		// $dataArray['RoomGuests'] =  json_decode(json_encode($dataArray['RoomGuests']), TRUE); //

		$url = "http://api.tektravels.com/BookingEngineService_Hotel/hotelservice.svc/rest/BlockRoom/";

		$this->CurlRequest($url, $dataArray);
		
		die();
	}


	/*
		Book method is called to either hold a booking or to book and voucher a booking based on the selected rooms and guest information. We strongly recommend checking the updated prices and cancellation policies for the selected rooms through BlockRoom method before proceeding with the hotel booking to reduce the probability of booking failure.

		To hold a booking, the IsVouchered node should be set as false. However, all hold bookings should be vouchered by calling GenerateVoucher method before last cancellation date to avoid cancellation of confirmed booking.

		To book and voucher in one go, the IsVouchered node should be set as true. In this case, there is no need to callGenerateVoucher method separately.

		Price verification is done before creating a booking and Confirmation No. / Booking Reference No. is returned in case of a successful booking.

		In case of Price change or Cancellation Policy change, you will get new price and/or new cancellation policy in the HotelBook response with IsPriceChanged node and/or IsCancellationPolicyChanged node set as ‘true’.

		The price comparison is to be made at the client's end, and Book request needs to be sent again with the updated price and/ or updated cancellation policy.

		Instead of 'Vouchered' or 'Confirmed' you might get 'Pending' as BookingStatus for some bookings. This is because some of the suppliers do not provide confirmation of the booking immediately. In this case you need to call HotelBookingDetail method after few minutes (5-10) to get the updated status.
	*/
	public function Book()
	{

		$dataArray = $this->request->data;

		$dataArray['Price'] = [
								"CurrencyCode" 				=> 	 $dataArray['CurrencyCode'], 
								"RoomPrice" 				=>   $dataArray['RoomPrice'], 
								"Tax" 						=>   $dataArray['Tax'],
								"ExtraGuestCharge" 			=>   $dataArray['ExtraGuestCharge'],
								"ChildCharge" 				=>   $dataArray['ChildCharge'],
								"OtherCharges" 				=>   $dataArray['OtherCharges'],
								"Discount" 					=>   $dataArray['Discount'],
								"PublishedPrice" 			=>   $dataArray['PublishedPrice'],
								"PublishedPriceRoundedOff" 	=>   $dataArray['PublishedPriceRoundedOff'],
								"OfferedPrice" 				=>   $dataArray['OfferedPrice'],
								"OfferedPriceRoundedOff" 	=>   $dataArray['OfferedPriceRoundedOff'],
								"AgentCommission" 			=>   $dataArray['AgentCommission'],
								"AgentMarkUp" 				=>   $dataArray['AgentMarkUp'],
								"ServiceTax" 				=>   $dataArray['ServiceTax'],
								"TDS" 						=>   $dataArray['TDS']
							];

		$dataArray['Price'] =  json_decode(json_encode($dataArray['Price']), TRUE); 


		$dataArray['HotelPassenger'] = [

											"Title" 			=> $dataArray['Title'],
											"FirstName" 		=> $dataArray['FirstName'],
											"Middlename" 		=> $dataArray['Middlename'],
											"LastName" 			=> $dataArray['LastName'],
											"Phoneno" 			=> $dataArray['Phoneno'],
											"Email" 			=> $dataArray['Email'],
											"PaxType" 			=> $dataArray['PaxType'],
											"LeadPassenger" 	=> $dataArray['LeadPassenger'],
											"Age" 				=> $dataArray['Age'],
											"PassportNo" 		=> $dataArray['PassportNo'],
											"PassportIssueDate" => $dataArray['PassportIssueDate'],
											"PassportExpDate" 	=> $dataArray['PassportExpDate']
										];

		
		$dataArray['HotelPassenger'] = json_decode(json_encode($dataArray['HotelPassenger']), TRUE);



		// $dataArray['Price'] = $dataArray['Price'];

		$dataArray['HotelRoomsDetails'] = [

											"RoomIndex" 		=> $dataArray['RoomIndex'],
											"RoomTypeCode" 		=> $dataArray['RoomTypeCode'],
											"RoomTypeName" 		=> $dataArray['RoomTypeName'],
											"RatePlanCode" 		=> $dataArray['RatePlanCode'],
											"BedTypeCode" 		=> $dataArray['BedTypeCode'],
											"SmokingPreference" => $dataArray['SmokingPreference'],
											"Supplements" 		=> $dataArray['Supplements'],
											"Price" 			=> $dataArray['Price'],
											"HotelPassenger" 	=> $dataArray['HotelPassenger']
										];

		$dataArray['HotelRoomsDetails'] = json_decode(json_encode($dataArray['HotelRoomsDetails']), TRUE); 



		unset(
				$dataArray['CurrencyCode'],
				$dataArray['RoomPrice'],  
				$dataArray['Tax'],
				$dataArray['ExtraGuestCharge'],
				$dataArray['ChildCharge'],
				$dataArray['OtherCharges'],
				$dataArray['Discount'],
				$dataArray['PublishedPrice'],								
				$dataArray['PublishedPriceRoundedOff'],
				$dataArray['OfferedPrice'],
				$dataArray['OfferedPriceRoundedOff'],
				$dataArray['AgentCommission'],
				$dataArray['AgentMarkUp'],
				$dataArray['ServiceTax'],
				$dataArray['TDS'],

				$dataArray['RoomIndex'],
				$dataArray['RoomTypeCode'],
				$dataArray['RoomTypeName'],
				$dataArray['RatePlanCode'],
				$dataArray['BedTypeCode'],
				$dataArray['SmokingPreference'],
				$dataArray['Supplements'],
				$dataArray['Price'],

				$dataArray['Title'],
				$dataArray['FirstName'],
				$dataArray['Middlename'],
				$dataArray['LastName'],
				$dataArray['Phoneno'],
				$dataArray['Email'],
				$dataArray['PaxType'],
				$dataArray['LeadPassenger'],
				$dataArray['Age'],
				$dataArray['PassportNo'],
				$dataArray['PassportIssueDate'],
				$dataArray['PassportExpDate'],
				$dataArray['HotelPassenger']

			);


		$url = "http://api.tektravels.com/BookingEngineService_Hotel/hotelservice.svc/rest/Book/";

		$this->CurlRequest($url, $dataArray);
		
		die();
	}

	/*
		GenerateVoucher method is used to voucher hold bookings. All Hold Bookings should be vouchered before the before Last Cancellation Date. Failure to do so may leady to cancellation of the booking.

		Instead of 'Vouchered' or 'Confirmed' you might get 'Pending' as BookingStatus for some bookings. This is because some of the suppliers do not provide confirmation of the booking immediately. In this case you need to call HotelBookingDetail method after few minutes (5-10) to get the updated status.
	*/
	public function GenerateVoucher()
	{

		$dataArray = $this->request->data;

		$url = "http://api.tektravels.com/BookingEngineService_Hotel/hotelservice.svc/rest/GenerateVoucher/";

		$this->CurlRequest($url, $dataArray);
		
		die();
	}


	/*
		This method gets the booking information based on Booking ID or Confirmation No or Trace ID or Client Reference Number.

		It is also used to retrieve the booking status which might be confirmed, vouchered, pending, failed, cancelled, etc.
	*/
	public function GetBookingDetail()
	{

		$dataArray = $this->request->data;

		$url = "http://api.tektravels.com/BookingEngineService_Hotel/HotelService.svc/rest/GetBookingDetail/";

		$this->CurlRequest($url, $dataArray);
		
		die();
	}

	/*
		This method is used to cancel a hold or vouchered booking.
	*/
	public function SendChangeRequest()
	{

		$dataArray = $this->request->data;

		$url = "http://api.tektravels.com/BookingEngineService_Hotel/hotelservice.svc/rest/SendChangeRequest/";

		$this->CurlRequest($url, $dataArray);
		
		die();
	}

	/*
		This method is used to check the Cancellation status using change request id and also to know cancellation charges and refunded amount.
	*/
	public function GetChangeRequestStatus()
	{

		$dataArray = $this->request->data;

		$url = "http://api.tektravels.com/BookingEngineService_Hotel/hotelservice.svc/rest/GetChangeRequestStatus/";

		$this->CurlRequest($url, $dataArray);
		
		die();
	}

	// /*
	// 	This method is used to check the Cancellation status using change request id and also to know cancellation charges and refunded amount.
	// */
	// public function GetChangeRequestStatus()
	// {

	// 	$dataArray = $this->request->data;

	// 	$url = "http://api.tektravels.com/BookingEngineService_Hotel/hotelservice.svc/rest/GetChangeRequestStatus/";

	// 	$this->CurlRequest($url, $dataArray);
		
	// 	die();
	// }




}