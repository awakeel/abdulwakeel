<?php
class Posts
{ 
	 
	function __construct( $app){ 
	    	$app->get('/posts', function () {
	    		 $this->getAllPosts();
	    	});
    		 $app->post('/posts',function(){
            $request = Slim::getInstance()->request();
            $this->savePost($request);
        });
    			
    }
     
    function getAllPosts() {  
    	 
    	$sql = "select * from posts";
    	    try {
              	$posts = R::getAll($sql);
                if (!isset($_GET['callback'])) {
	                echo json_encode($posts);
	            } else {
	                echo $_GET['callback'] . '(' . json_encode($posts) . ');';
	            }
 			 } catch(PDOException $e) {
                    $error = array("error"=> array("text"=>$e->getMessage()));
                    echo json_encode($error);
            }
    }
     
    function savePost($request){
    	 
    		$params = json_decode($request->getBody());
    		try {
	    		 
	    			$posts = R::dispense( 'posts' );
	    			 $posts->title = $params->title;
	    			 $posts->text = $params->text;
	    			 $posts->createdon = R::isoDateTime();
	    			 
	    			 $id = R::store($posts);
	    		 
    		  		echo json_encode($params);
    		 } catch(PDOException $e) {
    			  echo '{"error":{"text":'. $e->getMessage() .'}}';
    		 }
    		 
    	 
    }
    function deleteJobTypes(){
    	 $id = $_GET['id'];
    	$sql = "delete from jobtypes where id=$id";
    	 
    	try {
    		$jobtypes = R::exec($sql);
    		echo json_encode($id);
    	} catch(Exception $e) {
    		//error_log($e->getMessage(), 3, '/var/tmp/php.log');
    		echo json_encode(['error'=>'Integrity constraint'] );
    	}
    }
}
?>