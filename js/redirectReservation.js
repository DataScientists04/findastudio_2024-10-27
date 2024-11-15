function redirectReservation(studioID) {
    fetch('/FindAStudio/php/checkLogin.php', {
        method: 'GET',
        credentials: 'include'
    })
      .then(response => response.json())
      .then(data => {
        if (data.loggedin) {
          window.location.href = `/FindAStudio/pages/reservation.php?StudioID=${studioID}`;
        } else {
            window.location.href = '/FindAStudio/pages/SignUp.php'; 
        }
      })
      .catch(error => {
        console.error('Error:', error);
        alert("An error occurred.");
      });
  }


  