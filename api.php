
 <!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>
	body {
    background-color: #f8f8f8;
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

.chat-container {
    margin: 50px auto;
    max-width: 600px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}

.header {
    background-color: #007bff;
    color: #fff;
    text-align: center;
    padding: 10px;
    border-radius: 10px 10px 0 0;
}

.chatbox {
    display: flex;
    flex-direction: column;
    padding: 20px;
    height: 400px;
    overflow-y: auto;
}

.chatlog {
    margin-bottom: 10px;
}

.chatlog .chat-message {
    margin-bottom: 10px;
    display: flex;
    flex-direction: column;
}

.chatlog .chat-message .message-text {
    padding: 10px;
    border-radius: 10px;
    max-width: 70%;
    margin-bottom: 5px;
}

.chatlog .chat-message .message-text.user {
    background-color: #007bff;
    color: #fff;
    align-self: flex-end;
}

.chatlog .chat-message .message-text.bot {
    background-color: #f1f1f1;
    color: #000;
    align-self: flex-start;
}

.input-box {
    display: flex;
    align-items: center;
}

.input-box input[type=text] {
    flex-grow: 1;
    padding: 10px;
    border-radius: 5px;
    border: none;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    margin-right: 10px;
}

.input-box button {
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    cursor: pointer;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}

.input-box button:hover {
    background-color: #0056b3;
}

	</style>
</head>
<body>
<form method="post">
    <div class="chat-container">
        <div class="header">
            <h1>Chatbot</h1>
        </div>
        <div class="chatbox">
            <div class="chatlog">
                <!-- chatlog will be displayed here -->
            </div>
            <div class="input-box">
                <input type="text" id="user-input" name="str" placeholder="Type your message here...">
                <button type="submit">Submit</button>
            </div>
			
        </div>
		<?php
	if(isset($_POST['str']))
	{
	$ch = curl_init();
	$str=$_POST['str'];
	curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/completions');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	$postdata = array( "model"=> "text-davinci-001",
	  "prompt"=> $str,
	  "temperature"=> 0.4,
	  "max_tokens"=> 1400,
	  "top_p"=> 1,
	  "frequency_penalty"=> 0,
	  "presence_penalty"=> 0);
	$postdata = json_encode($postdata);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata); 
	
	$headers = array();
	$headers[] = 'Content-Type: application/json';
	$headers[] = 'Authorization: Bearer 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';
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	
	$result = curl_exec($ch);
	if (curl_errno($ch)) {
		echo 'Error:' . curl_error($ch);
	}
	curl_close($ch);
	$result= json_decode($result, true);
	echo $result['choices'] [0] ['text'];
}
		
?>

    </div>
	
    </form>
</body>

</html> 
