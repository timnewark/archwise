document.getElementById('contact-form').addEventListener('submit', async function(event) {
  event.preventDefault(); // Prevent the form from submitting the traditional way

  const formData = new FormData(this);
  
  // If using Cloudflare Turnstile, append the token to formData
  // formData.append('cf-turnstile-response', theTokenValue);

  try {
    const response = await fetch('/api/contact', {
      method: 'POST',
      body: formData,
    });

    if (response.ok) {
      alert('Message sent successfully!');
      this.reset(); // Optionally reset the form on success
    } else {
      alert('Failed to send message. Please try again.');
    }
  } catch (error) {
    console.error('Error:', error);
    alert('An error occurred. Please try again.');
  }
});
