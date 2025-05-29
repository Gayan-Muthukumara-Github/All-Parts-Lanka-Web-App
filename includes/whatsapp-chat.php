<?php
// WhatsApp number - replace with your business number
$whatsapp_number = "94712345678"; // Format: country code + number without + or spaces
?>

<!-- WhatsApp Chat Button -->
<div class="whatsapp-chat">
    <button class="whatsapp-button" onclick="toggleChat()">
        <i class="fab fa-whatsapp"></i>
    </button>
    <div class="chat-box" id="chatBox">
        <div class="chat-header">
            <h5>Chat with us</h5>
            <button onclick="toggleChat()" class="close-btn">&times;</button>
        </div>
        <div class="chat-body">
            <p>Click the button below to start chatting on WhatsApp</p>
            <a href="https://wa.me/<?php echo $whatsapp_number; ?>" target="_blank" class="btn btn-success btn-block">
                <i class="fab fa-whatsapp"></i> Start Chat
            </a>
        </div>
    </div>
</div>

<style>
.whatsapp-chat {
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 1000;
}

.whatsapp-button {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background-color: #25d366;
    color: white;
    border: none;
    box-shadow: 0 2px 10px rgba(0,0,0,0.2);
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 30px;
    transition: all 0.3s ease;
}

.whatsapp-button:hover {
    transform: scale(1.1);
    background-color: #128C7E;
}

.chat-box {
    position: fixed;
    bottom: 90px;
    right: 20px;
    width: 300px;
    background: white;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    display: none;
    overflow: hidden;
}

.chat-header {
    background: #25d366;
    color: white;
    padding: 15px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.chat-header h5 {
    margin: 0;
    font-size: 16px;
}

.close-btn {
    background: none;
    border: none;
    color: white;
    font-size: 24px;
    cursor: pointer;
    padding: 0;
}

.chat-body {
    padding: 20px;
    text-align: center;
}

.chat-body p {
    margin-bottom: 15px;
    color: #666;
}

.chat-body .btn {
    background: #25d366;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
    display: inline-block;
    transition: background 0.3s ease;
}

.chat-body .btn:hover {
    background: #128C7E;
    color: white;
    text-decoration: none;
}
</style>

<script>
function toggleChat() {
    const chatBox = document.getElementById('chatBox');
    if (chatBox.style.display === 'block') {
        chatBox.style.display = 'none';
    } else {
        chatBox.style.display = 'block';
    }
}
</script> 