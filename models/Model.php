<?php 
require_once($_SERVER['DOCUMENT_ROOT'].'/interfaces/Database.php');	

class Model implements Database {
	public static function get_db($query) {
		$host = 'localhost';
		$username = 'root';
		$password = '';
		$db = 'b1_ecom';
		$cn = mysqli_connect($host, $username, $password, $db);

		return mysqli_query($cn, $query);
	}

        public static function get_cn() {
                $host = 'localhost';
                $username = 'root';
                $password = '';
                $db = 'b1_ecom';
                $cn = mysqli_connect($host, $username, $password, $db);
                // var_dump($cn);
                // $order_id = mysqli_insert_id(Model::get_cn());
                // var_dump($order_id);
                return $cn;
        }

	public static function send_email($post){
        // Send an Email
        var_dump($post);
        // Create the Transport
        $transport = (new Swift_SmtpTransport('smtp.gmail.com', 587, 'tls'))
        ->setUsername('wongwaikit2873@gmail.com')
        ->setPassword('kelvin5365');
        
        // Create the Mailer using your created Transport
        $mailer = new Swift_Mailer($transport);
        
        // Create a message
        $message = (new Swift_Message('B1-ECOM Registration'))
        	->setFrom(['wongwaikit2873@gmail.com' => 'Kelvin Wong'])
        	->setTo([$post['email'] => $post['firstname']])
        	->setBody('Thank you for registering on B1-ECOM');
        // Send the message
        
        $result = $mailer->send($message);
	}
}
?>