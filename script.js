// Get references to the button and message elements
const button = document.getElementById('myButton');
const message = document.getElementById('message');

// Add an event listener to the button
button.addEventListener('click', function() {
  message.textContent = 'Hello, you clicked the button!';
});
