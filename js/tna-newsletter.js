/**
 * TNA Newsletter
 * Enable/Disable Submit button when the user accepts TNA's Privacy Policy
 */
var tnaNewsLetter = function() {
  var btn = document.querySelector('#newsletterSignUp');
  var checkBox = document.querySelector('#privacy_policy');

  // Disable Submit button by default
  btn.disabled = true;

  checkBox.addEventListener('click', function(e) {
    if (e.target.checked) {
      btn.disabled = false;
      btn.classList.remove('disabled');
    } else {
      btn.disabled = true;
      btn.classList.add('disabled');
    }
  });
};

window.addEventListener('DOMContentLoaded', tnaNewsLetter);