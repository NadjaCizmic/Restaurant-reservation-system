// Smooth scrolling for navigation links
$(document).ready(function() {
    $('a.nav-link').on('click', function(event) {
      if (this.hash !== '') {
        event.preventDefault();
        var hash = this.hash;
        $('html, body').animate({
          scrollTop: $(hash).offset().top
        }, 800);
      }
    });
  
    // Form submission
    $('#reservation-form').submit(function(event) {
      event.preventDefault();
  
      // Collect form data
      var firstName = $('#first-name').val();
      var lastName = $('#last-name').val();
      var email = $('#email').val();
      var phone = $('#phone').val();
      var peopleCount = $('#people-count').val();
      var dateTime = $('#datetime').val();
  
      // Perform form validation
      if (firstName === '' || lastName === '' || email === '' || phone === '' || peopleCount === '' || dateTime === '') {
        alert('Please fill in all fields.');
        return;
      }
  
      // Process form submission (e.g., send data to server)
      // Replace this with your own code
  
      // Reset the form
      $('#reservation-form')[0].reset();
      alert('Reservation submitted successfully!');
    });
  });
  