<?php 
  session_start();
  include_once "php/config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: users.php");
  }
?>
<?php 
    $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
    if(mysqli_num_rows($sql) > 0){
        $row = mysqli_fetch_assoc($sql);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            width: 100%;
            background-image: url(../images/dot_effect.png);
            background-color: #c2d5e8;
            min-height: 100%;
        }

        #chat-container {
            max-width: 100%;
            max-height: 100%;
            margin-top: 2em;
            margin-right: 2em;
        }

        .message {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .profile-image {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 20px;
            margin-left: 2em;
        }

        .message-content {
            font-size: 1.4em;
            padding: 5px;
            background-color: #fff;
            border-radius: 5px;
            margin-bottom:5px;
        }

        #user-input {
            position: fixed;
            bottom: 0;
            width: 100%;
            height: 3em;
            border: 1px solid grey;
            padding: 1em 2em;
        }

        #loading-animation {
            display: none; /* Initially hide the loading animation */
            align-items: center;
            justify-content: center;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.8);
            z-index: 999;
        }
    </style>
</head>
<body  id="chatbot-chatting">
    <div id="chat-container">
        <div id="chat-display"></div>
        <input type="text" id="user-input" placeholder="Type your message...">
        <div id="loading-animation" class="loading">Loading...</div>
    </div>

    <script>
        const chatDisplay = document.getElementById('chat-display');
        const userInput = document.getElementById('user-input');

        const apiKey = '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';

        function appendSystemMessage(message) {
            const systemMessage = document.createElement('div');
            systemMessage.className = 'message system';
            systemMessage.innerText = message;
            chatDisplay.appendChild(systemMessage);
        }

        function appendUserMessage(message) {
            const userMessage = document.createElement('div');
            userMessage.className = 'message user';

            // Create the user profile image element
            const userProfileImage = document.createElement('img');
            userProfileImage.src = "php/images/<?php echo $row['img']; ?>";
            userProfileImage.alt = 'User Profile';
            userProfileImage.className = 'profile-image';

            // Create the message content element
            const messageContent = document.createElement('div');
            messageContent.className = 'message-content';
            messageContent.innerText = message;

            // Append elements to the user message div
            userMessage.appendChild(userProfileImage);
            userMessage.appendChild(messageContent);

            chatDisplay.appendChild(userMessage);
        }

        function appendAssistantMessage(message) {
            const assistantMessage = document.createElement('div');
            assistantMessage.className = 'message assistant';

            // Create the AI profile image element
            const aiProfileImage = document.createElement('img');
            aiProfileImage.src = '../images/ai.png'; // Update with the AI's image URL
            aiProfileImage.alt = 'AI Profile';
            aiProfileImage.className = 'profile-image';

            // Create the message content element
            const messageContent = document.createElement('div');
            messageContent.className = 'message-content';
            messageContent.innerText = message;

            // Append elements to the AI message div
            assistantMessage.appendChild(aiProfileImage);
            assistantMessage.appendChild(messageContent);

            chatDisplay.appendChild(assistantMessage);
        }

        function showLoadingAnimation() {
            const loadingAnimation = document.getElementById('loading-animation');
            loadingAnimation.style.display = 'flex'; // Show the loading animation
        }

        function hideLoadingAnimation() {
            const loadingAnimation = document.getElementById('loading-animation');
            loadingAnimation.style.display = 'none'; // Hide the loading animation
        }

        function sendUserMessage(message) {
            appendUserMessage(message);
            showLoadingAnimation(); // Show loading animation while waiting for a response

            fetch('https://api.openai.com/v1/chat/completions', {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${apiKey}`,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    model: 'gpt-3.5-turbo',
                    messages: [
                        { role: 'system', content: 'Psychologist' },
                        { role: 'user', content: message }
                    ]
                })
            })
                .then(response => response.json())
                .then(data => {
                    const assistantReply = data.choices[0].message.content;
                    appendAssistantMessage(assistantReply);
                    hideLoadingAnimation(); // Hide loading animation when the response is received
                })
                .catch(error => {
                    console.error('Error:', error);
                    hideLoadingAnimation(); // Hide loading animation on error
                });
        }

        // Function to send the initial message from the chatbot
        function sendInitialMessage() {
            const initialMessage = "Hello! How can I assist you today?";
            appendAssistantMessage(initialMessage);
        }

        // Call the function to send the initial message when the chat page loads
        sendInitialMessage();

        userInput.addEventListener('keydown', (event) => {
            if (event.key === 'Enter') {
                const userMessage = userInput.value;
                userInput.value = '';
                sendUserMessage(userMessage);
            }
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
