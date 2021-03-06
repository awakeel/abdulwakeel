<?php
class Booking{
	 
	function __construct($app){
    	$this->branchid = @$_SESSION['branchid'];
	    	$app->get('/bookings', function () { 
	    		$this->getAllBookings();
	    	});
    		$app->get('/employeesgetall', function () {
    			$this->getAll(1);
    		});
	    	$app->post('/bookings',function(){
	    		$request = Slim::getInstance()->request();
	    		$this->saveBooking($request);
	    	});
	    		$app->get('/deletebooking',function(){
	    			 
	    			$this->deleteBooking( );
	    		});
	    			$app->get('/bookingstatuschange',function(){
	    				 
	    				$this->changeStatusBooking( );
	    			});
	    			
	    		
	 }
	 function getAllBookings() {
	 	$branchid = @$_GET['branchid'];
	 	$search = @$_GET['search'];
	 	if(isset($search) && !empty($search)){
	 		$search = " and (  s.name  like '%".$search."%' or b.title  like '%".$search."%')";
	 	}
	 	$today = "";
	 	if(isset($_GET['today']) && !empty($_GET['today'])){
	 		$today = $_GET['today'];
	 		$day = date("Ymd");
	 		$today = " and dayid = ".$day;
	 	}
	 	$limit = " limit 20";
	 	if(isset($_GET['offset']) && !empty($_GET['offset'])){
	 		$offset = $_GET['offset'];
	 		$limit = " limit $offset,20";
	 	}
	  	$sql = " SELECT  b.*,j.name as jobtype, Ifnull(e.firstname, 'None') as emp, ifNull(c.name,'Anonymous') AS customer,c.id as customerid, s.name AS service FROM bookings b
					INNER JOIN branches br ON br.id = b.`branchid`
					INNER JOIN services s ON s.id = b.`serviceid`
					inner join jobtypes j on j.id = b.jobtypeid
					LEFT JOIN employees e ON e.id = b.`employeeid`
					INNER JOIN customers c ON c.id = b.`customerid`
					WHERE b.branchid = $branchid $today  $search order by b.dayid desc $limit";
	 	try {
	 		$bookings = R::getAll($sql); 
	 		if (!isset($_GET['callback'])) {
	 			echo json_encode($bookings);
	 		} else {
	 			echo $_GET['callback'] . '(' . json_encode($bookings) . ');';
	 		}
	 	} catch(PDOException $e) {
	 		$error = array("error"=> array("text"=>$e->getMessage()));
	 		echo json_encode($error);
	 	}
	 }
	  
	 function saveBooking($request){
	 
	 	$params = json_decode($request->getBody());
	 	try {
	 		if(isset($params->id) && !empty($params->id)){
	 			$jobtypes = R::dispense( 'jobtypes' );
	 			$jobtypes->id = $params->id;
	 			$jobtypes->name = $params->name;
	 			$jobtypes->color = $params->color;
	 			$jobtypes->comments = $params->comments;
	 			$jobtypes->franchiseid = $params->franchiseid; 
	 			$id = R::store($jobtypes);
	 		}else{
	 			$customerid = 0;
	 			if(isset($params->customerid) && !empty($params->customerid)){
	 			  $customerid = $params->customerid;
	 			}else{
	 				$customerid = $this->saveCustomer($params->customername,$params->email,$params->phone,$params->branchid,$params->franchiseid);
	 			}
	 			$booking = R::dispense('bookings');
	 			$booking->title = $params->title;
	 			$booking->employeeid = $params->employeeid;
	 			$booking->jobtypeid = $params->jobtypeid;
	 			$booking->branchid = $params->branchid;
	 			$booking->franchiseid = $params->franchiseid;
	 			$booking->serviceid = $params->serviceid;
	 			$booking->timestart = $params->timestart;
	 			$booking->timeend = $params->timeend;
	 			$booking->bookingtype = $params->bookingtype;
	 			$booking->price = $params->price;
	 			$booking->dayid = $params->dayid;
	 			$booking->customerid = $customerid;
	 			$booking->status = $params->status; 
	 			$booking->createdon = R::isoDate();
	 			$booking->isdeleted = 0;
	 			$booking->isactivated = 0;
	 			$booking->createdbyid = $params->franchiseid;
	 			$id = R::store($booking); 
	 		}
	 		 echo json_encode($params);
	 	} catch(PDOException $e) {
	 		 echo '{"error":{"text":'. $e->getMessage() .'}}';
	 	}
	 	 
	 
	 }
	 function saveCustomer($name,$email,$phone,$branchid,$franchiseid){
	 	$customer = R::dispense( 'customers' );
	 	if(empty($name) && empty($name) && empty($name)){
	 		$customer->createdon = R::isoDate();
	 		$customer->branchid = $branchid;
	 		$customer->franchiseid = $franchiseid;
	 		$customer->isregistered= 0;
	 	}else{
	 		$customer->name = $name;
	 		$customer->email = $email;
	 		$customer->phone = $phone;
	 		$customer->createdon = R::isoDate();
	 		$customer->branchid = $branchid;
	 		$customer->franchiseid = $franchiseid;
	 		$customer->isregistered= 1;
	 	}
	 	
	 	$id = R::store($customer);
	 	return $id;
	 }
	 function changeStatusBooking(){
	 	$customer = R::dispense( 'bookings' );
	 	$customer->status = $_GET['status'];
	 	$customer->id = $_GET['id'];
	 	$id = R::store($customer);
	 	echo json_encode($id);
	 } 
	 function deleteBooking(){
	 	$id = $_GET['id'];
	 	$sql = "delete from bookings where id=$id";
	 
	 	try {
	 		$jobtypes = R::exec($sql);
	 		echo json_encode($id);
	 	} catch(Exception $e) {
	 		//error_log($e->getMessage(), 3, '/var/tmp/php.log');
	 		echo json_encode(['error'=>'Integrity constraint'] );
	 	}
	 }
	
}