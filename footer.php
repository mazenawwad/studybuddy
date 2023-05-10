<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <footer class= "footer">
        <div class="inner-footer">
            <div class="card">
                <h3>Meet The Devs</h3>
                <p>-Mohammad Hammoud</p>
                <ul class="socials">
                    <li>Email: <i class="bi bi-envelope-fill"></i> mohammadhammoud14@lau.edu</li>
                    <li>Phone: <i class="bi bi-whatsapp"></i>  +961 70 554 528 </li>
                    <li>LinkedIn: <i class="bi bi-linkedin"></i><a href="https://www.linkedin.com/in/mohammad-hammoud-088159233/"> Mohammad Hammoud</a></li>
                </ul>
                <p>-Mazen Awwad</p>
                <ul class="socials">
                    <li>Email: <i class="bi bi-envelope-fill"></i> mazen.awwad01@lau.edu</li>
                    <li>Phone: <i class="bi bi-whatsapp"></i>  +961 70 357 253 </li>
                    <li>LinkedIn: <i class="bi bi-linkedin"></i><a href="https://www.linkedin.com/in/mazenawwad/"> Mazen Awwad</a></li>
                </ul>
            </div>
            <div class="card">
                <h3>Location</h3>
                <p>Our company was founded inside LAU's Campus.<br></br>
                    Our main branch is located in:
                <ul>
                   <li> Beirut, Koraytem, Lebanese American University</li>
                </ul>
                    Our office is located in:
                </p>
                    <ul>
                        <li>Nicol Hall, Level 5, Room 520</li>
                    </ul>
            </div>
            <div class="card">
            <div class="card">
  <h3>Recommendations</h3>
  <br></br>
  <div class="input-field">
    <form id="emailForm" action="mailto: mazen.awwad01@lau.edu" method="POST" enctype="text/plain">
    <input type="text" name="suggestion" id="emailInput" placeholder="What do you suggest?" style="height: 44.5px;">
      <i class="bi bi-envelope" id="sendButton"></i>
    </form>
  </div>
</div>


<script>
  const sendButton = document.getElementById('sendButton');
  const emailForm = document.getElementById('emailForm');

  sendButton.addEventListener('click', function() {
    emailForm.submit();
  });
</script>
        </div>
        </div>
        <div class="bottom-footer">
            <p>all right reserved ® - Mazen and Hammoud </p>
        </div>
    </footer>
</body>

</html>