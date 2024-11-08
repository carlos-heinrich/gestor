function sendMessage() {
    var userInput = document.getElementById("user-input").value;
    if (userInput.trim() === "") return;

    appendMessage("You: " + userInput);
    document.getElementById("user-input").value = "";
    showTypingIndicator();

    // Send the user message to PHP for processing
    sendToPHP(userInput);
}

function appendMessage(message, isBot = false) {
    var chatBox = document.getElementById("chat-box");
    var p = document.createElement("p");
    p.textContent = message;
    if (isBot) {
        p.classList.add("bot-message");
    }
    chatBox.appendChild(p);
    chatBox.scrollTop = chatBox.scrollHeight;
}

function showTypingIndicator() {
    var typingIndicator = document.getElementById("typing-indicator");
    typingIndicator.textContent = "Bot is typing...";
}

function hideTypingIndicator() {
    var typingIndicator = document.getElementById("typing-indicator");
    typingIndicator.textContent = "";
}

function sendToPHP(userInput) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "process.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = xhr.responseText;
            appendMessage("Bot: " + response, true);
            hideTypingIndicator();
        }
    };
    xhr.send("userInput=" + userInput);
}










document.addEventListener("DOMContentLoaded", function() {
    var loadingScreen = document.getElementById("loading-screen");
    var content = document.getElementById("content");

    
    setTimeout(function() {
        loadingScreen.style.display = 'none';
        content.style.display = 'block';
    }, 1000); // Atraso de 3 segundos
});
