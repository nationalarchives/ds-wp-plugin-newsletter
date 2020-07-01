/**
 * TNA Newsletter
 * Enable/Disable Submit button when the user accepts TNA's Privacy Policy
 */
var dsWpPluginNewsletter = function() {
  var btn = document.querySelector('#newsletterSignUp');

  if(btn !== null && btn !== 'undefined') {
    var checkBox = document.querySelector('#privacy_policy');

    // Disable Submit button on page load
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
  }

};

window.addEventListener('DOMContentLoaded', dsWpPluginNewsletter);
